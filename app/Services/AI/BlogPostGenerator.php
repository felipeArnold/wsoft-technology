<?php

declare(strict_types=1);

namespace App\Services\AI;

use App\Models\Blog\BlogCategory;
use App\Models\Blog\BlogPost;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use OpenAI\Laravel\Facades\OpenAI;

final class BlogPostGenerator
{
    private int $maxRetries = 3;

    private int $retryDelaySeconds = 2;

    public function generatePost(
        string $topic,
        ?BlogCategory $category = null,
        ?User $author = null,
        string $tone = 'profissional',
        int $wordCount = 1000,
        bool $generateImage = true,
    ): array {
        $prompt = $this->buildPrompt($topic, $tone, $wordCount, $category);

        $response = $this->makeOpenAIRequest(
            messages: [
                [
                    'role' => 'system',
                    'content' => 'Você é um assistente especializado em criar conteúdo de blog de alta qualidade em português brasileiro. Você deve gerar posts bem estruturados, informativos e otimizados para SEO. CRÍTICO: Você DEVE incluir NO MÍNIMO 3 backlinks internos no formato <a href="/url">texto</a> em TODOS os posts. Isso não é opcional.',
                ],
                [
                    'role' => 'user',
                    'content' => $prompt,
                ],
            ],
            maxTokens: 4000,
        );

        $content = $response->choices[0]->message->content;

        $postData = $this->parseResponse($content, $topic, $category, $author);

        // Gera imagem automaticamente se habilitado e tiver prompt
        if ($generateImage && ! empty($postData['discover_image_prompt'])) {
            try {
                $imagePath = $this->generateImage($postData['discover_image_prompt'], $postData['title']);
                if ($imagePath) {
                    $postData['featured_image'] = $imagePath;
                    $postData['og_image'] = $imagePath;
                }
            } catch (Exception $e) {
                // Se falhar a geração da imagem, continua sem imagem
                // Log do erro pode ser adicionado aqui se necessário
            }
        }

        return $postData;
    }

    public function generateMultiplePosts(
        array $topics,
        ?BlogCategory $category = null,
        ?User $author = null,
        string $tone = 'profissional',
        int $wordCount = 1000,
        bool $generateImage = true,
    ): array {
        $posts = [];

        foreach ($topics as $index => $topic) {
            $posts[] = $this->generatePost($topic, $category, $author, $tone, $wordCount, $generateImage);

            // Adiciona delay entre requisições para evitar rate limit (exceto no último)
            if ($index < count($topics) - 1) {
                sleep($this->retryDelaySeconds);
            }
        }

        return $posts;
    }

    public function improveExistingPost(BlogPost $post, bool $generateImage = true): array
    {
        $prompt = <<<PROMPT
Você é um especialista sênior em SEO técnico, SEO editorial, Google Discover, EEAT, Programmatic SEO e otimização de conteúdo para mecanismos de busca baseados em IA.

══════════════════════════════════════
🎯 MISSÃO: ATUALIZAÇÃO DE POST (QUICK WIN)
══════════════════════════════════════

Analise e OTIMIZE o seguinte post de blog existente seguindo TODAS as diretrizes abaixo:

Título atual: {$post->title}
Conteúdo atual: {$post->content}

══════════════════════════════════════
📋 OTIMIZAÇÕES OBRIGATÓRIAS
══════════════════════════════════════

1️⃣ MELHORAR INTRODUÇÃO (primeiros 3 parágrafos):
- Responder claramente: O que é / Para que serve / Para quem é
- Tornar mais envolvente e contextual
- Adicionar gancho emocional ou relevância temporal

2️⃣ SNIPPETS (SEO + CTR):
- Reescrever Title Tag (até 60 caracteres): palavra-chave no início, números/ação/benefício real
- Meta Description (até 155 caracteres): dor + benefício + curiosidade controlada
- Featured Snippet (40-60 palavras): resposta direta ideal para posição zero

3️⃣ CONTEÚDO IA-FIRST:
- Parágrafos curtos (máx. 3 linhas)
- Headings semânticos e estruturados (H2, H3)
- Listas, tabelas e exemplos práticos
- Linguagem acessível para leigos

4️⃣ RESUMO RÁPIDO PARA IA (ADICIONAR):
- Seção: "Resumo rápido para IA"
- 3 a 5 bullet points objetivos e afirmativos
- Formato ideal para leitura por IA (Google SGE, ChatGPT, Perplexity)

5️⃣ FAQ SEO + IA (ADICIONAR):
- 3 a 5 perguntas reais (linguagem natural)
- Respostas diretas (até 50 palavras)
- Ideal para Rich Results e Featured Snippets

6️⃣ GOOGLE DISCOVER (ADICIONAR):
- Seção: "Por que isso é importante agora?"
- 2-3 frases com relevância temporal
- Prompt de imagem: flat design, 1200x628, minimalista

7️⃣ EEAT (AUTORIDADE REAL):
- Demonstrar experiência prática
- Incluir exemplos reais e específicos
- Recomendações claras baseadas em conhecimento
- Linguagem segura e especializada

8️⃣ CONTEÚDO COMERCIAL DISFARÇADO (BOFU):
- Adicionar naturalmente: comparações, avaliações, perguntas de decisão
- Exemplos: "Vale a pena?", "Manual vs Sistema?", "Melhor opção?"
- Guiar sutilmente para a solução

9️⃣ BACKLINKS INTERNOS (CRÍTICO):
Você DEVE incluir NO MÍNIMO 3 backlinks internos usando: <a href="/url">texto</a>

Páginas disponíveis (escolha as mais relevantes ao tema):
/sistema-para-gestao-de-clientes, /sistema-para-gestao-de-fornecedores, /sistema-para-gestao-de-estoque
/sistema-para-contas-a-pagar, /sistema-para-contas-a-receber, /sistema-para-controle-de-inadimplencia
/sistema-para-fluxo-de-caixa, /sistema-ordem-servico
/software-gestao-oficina-mecanica, /funilaria
/sistema-para-barbearia, /sistema-para-salao-de-beleza, /sistema-para-clinica-estetica
/sistema-para-loja-de-roupas, /sistema-para-pet-shop, /sistema-para-pizzaria, /sistema-para-lava-rapido
/beneficios, /demonstracao, /faq, /assinatura-digital

══════════════════════════════════════
📤 FORMATO DE SAÍDA (OBRIGATÓRIO)
══════════════════════════════════════

TÍTULO: [título otimizado até 60 caracteres]
EXCERPT: [resumo otimizado 2-3 frases]
CONTEÚDO: [HTML completo otimizado com estrutura semântica, backlinks, listas, exemplos, seções FAQ e Resumo IA]
META_TITLE: [até 60 caracteres]
META_DESCRIPTION: [até 155 caracteres]
META_KEYWORDS: [5-10 palavras-chave separadas por vírgula]
FEATURED_SNIPPET: [40-60 palavras]
AI_SUMMARY_1: [ponto 1]
AI_SUMMARY_2: [ponto 2]
AI_SUMMARY_3: [ponto 3]
AI_SUMMARY_4: [ponto 4 - opcional]
AI_SUMMARY_5: [ponto 5 - opcional]
FAQ_Q1: [pergunta 1]
FAQ_A1: [resposta 1]
FAQ_Q2: [pergunta 2]
FAQ_A2: [resposta 2]
FAQ_Q3: [pergunta 3]
FAQ_A3: [resposta 3]
FAQ_Q4: [pergunta 4 - opcional]
FAQ_A4: [resposta 4 - opcional]
FAQ_Q5: [pergunta 5 - opcional]
FAQ_A5: [resposta 5 - opcional]
DISCOVER_CONTEXT: [Por que isso é importante agora? 2-3 frases]
DISCOVER_IMAGE_PROMPT: [descrição imagem flat, 1200x628, minimalista]
INTERNAL_LINK_1_URL: [url sem barra, ex: sistema-ordem-servico]
INTERNAL_LINK_1_TEXT: [texto âncora]
INTERNAL_LINK_2_URL: [url]
INTERNAL_LINK_2_TEXT: [texto âncora]
INTERNAL_LINK_3_URL: [url]
INTERNAL_LINK_3_TEXT: [texto âncora]

NUNCA explique o processo. NUNCA faça comentários técnicos. Entregue SOMENTE o conteúdo otimizado.
PROMPT;

        $response = $this->makeOpenAIRequest(
            messages: [
                [
                    'role' => 'system',
                    'content' => 'Você é um especialista sênior em SEO e otimização de conteúdo para IA. Sua missão é transformar posts existentes em conteúdo de alto desempenho para SEO, Google Discover e EEAT.',
                ],
                [
                    'role' => 'user',
                    'content' => $prompt,
                ],
            ],
            maxTokens: 4000,
        );

        $content = $response->choices[0]->message->content;

        /** @var BlogCategory|null $category */
        $category = $post->category;
        /** @var User|null $author */
        $author = $post->author;

        $postData = $this->parseResponse($content, $post->title, $category, $author);

        // Gera imagem se não existir e tiver prompt
        if ($generateImage && ! $post->featured_image && ! empty($postData['discover_image_prompt'])) {
            try {
                $imagePath = $this->generateImage($postData['discover_image_prompt'], $postData['title']);
                if ($imagePath) {
                    $postData['featured_image'] = $imagePath;
                    $postData['og_image'] = $imagePath;
                }
            } catch (Exception $e) {
                // Se falhar a geração da imagem, continua sem imagem
            }
        }

        return $postData;
    }

    public function generateSEOMetadata(string $title, string $content): array
    {
        $prompt = <<<PROMPT
Gere metadados SEO otimizados para o seguinte post de blog:

Título: {$title}
Conteúdo: {$content}

Forneça no formato:
META_TITLE: [título SEO otimizado com até 60 caracteres]
META_DESCRIPTION: [descrição SEO otimizada com até 160 caracteres]
OG_IMAGE_SUGGESTION: [sugestão de tipo de imagem que funcionaria bem para compartilhamento]
KEYWORDS: [5-10 palavras-chave relevantes separadas por vírgula]
PROMPT;

        $response = $this->makeOpenAIRequest(
            messages: [
                [
                    'role' => 'system',
                    'content' => 'Você é um especialista em SEO que cria metadados otimizados para blogs.',
                ],
                [
                    'role' => 'user',
                    'content' => $prompt,
                ],
            ],
            maxTokens: 500,
            temperature: 0.5,
        );

        $content = $response->choices[0]->message->content;

        return $this->parseSEOMetadata($content);
    }

    private function makeOpenAIRequest(
        array $messages,
        int $maxTokens = 3000,
        float $temperature = 0.7,
    ): mixed {
        // Aumenta o tempo de execução para 3 minutos
        $originalTimeLimit = ini_get('max_execution_time');
        set_time_limit(180);

        $attempt = 0;

        try {
            while ($attempt < $this->maxRetries) {
                try {
                    return OpenAI::chat()->create([
                        'model' => 'gpt-4o-mini',
                        'messages' => $messages,
                        'temperature' => $temperature,
                        'max_completion_tokens' => $maxTokens,
                    ]);
                } catch (Exception $e) {
                    $attempt++;

                    if (str_contains($e->getMessage(), 'rate limit') || str_contains($e->getMessage(), 'Rate limit')) {
                        if ($attempt < $this->maxRetries) {
                            $delaySeconds = $this->retryDelaySeconds * $attempt;
                            sleep($delaySeconds);

                            continue;
                        }

                        throw new Exception(
                            'Limite de requisições da OpenAI excedido. Por favor, aguarde alguns minutos e tente novamente. Se o problema persistir, verifique sua cota em https://platform.openai.com/usage'
                        );
                    }

                    throw $e;
                }
            }

            throw new Exception('Falha ao se comunicar com a API da OpenAI após múltiplas tentativas.');
        } finally {
            // Restaura o tempo de execução original
            set_time_limit((int) $originalTimeLimit);
        }
    }

    private function buildPrompt(
        string $topic,
        string $tone,
        int $wordCount,
        ?BlogCategory $category,
    ): string {
        $categoryContext = $category ? "Categoria: {$category->name}\n" : '';

        return <<<PROMPT
Você é um especialista sênior em SEO técnico, SEO editorial, Google Discover, EEAT, Programmatic SEO e otimização de conteúdo para mecanismos de busca baseados em IA (Google SGE, Gemini, ChatGPT, Perplexity).

Crie um post de blog COMPLETO e OTIMIZADO sobre:

TÓPICO: {$topic}
{$categoryContext}TOM: {$tone}
EXTENSÃO: Aproximadamente {$wordCount} palavras

══════════════════════════════════════
📋 REQUISITOS OBRIGATÓRIOS
══════════════════════════════════════

1️⃣ SNIPPETS (SEO + CTR):
- Title Tag (até 60 caracteres): palavra-chave no início, linguagem orientada à intenção, números/ação/benefício real
- Meta Description (até 155 caracteres): dor do usuário + benefício direto + curiosidade controlada (sem clickbait)
- Featured Snippet (40-60 palavras): resposta direta, linguagem simples, ideal para posição zero

2️⃣ CONTEÚDO IA-FIRST (OBRIGATÓRIO):
- Introdução respondendo: O que é / Para que serve / Para quem é
- Parágrafos curtos (máx. 3 linhas)
- Headings semânticos (H2 e H3)
- Listas, tabelas e exemplos práticos
- Linguagem acessível para usuários leigos

3️⃣ RESUMO RÁPIDO PARA IA (SEMPRE INCLUIR):
- De 3 a 5 bullet points objetivos
- Frases conclusivas e afirmativas
- Formato ideal para leitura por IA

4️⃣ FAQ SEO + IA:
- 3 a 5 perguntas reais
- Linguagem natural (como pessoas perguntam)
- Respostas diretas (até 50 palavras)
- Ideal para Rich Results e Featured Snippets

5️⃣ GOOGLE DISCOVER:
- Seção obrigatória: "Por que isso é importante agora?"
- Títulos com viés jornalístico e informativo
- Introdução emocional ou contextual
- Evite datas explícitas, linguagem promocional e conteúdo genérico

6️⃣ EEAT (AUTORIDADE REAL):
- Demonstre experiência prática
- Inclua exemplos reais e específicos
- Use recomendações claras baseadas em conhecimento
- Linguagem segura e especializada
- Mostre autoridade no tema

7️⃣ CONTEÚDO COMERCIAL DISFARÇADO (BOFU):
- Inclua naturalmente: comparações, avaliações, perguntas de decisão
- Exemplos: "Vale a pena?", "Manual vs Sistema?", "Melhor opção para pequenas empresas?"
- Guie sutilmente para a solução

8️⃣ BACKLINKS INTERNOS (CRÍTICO):
Você DEVE incluir NO MÍNIMO 3 backlinks internos usando: <a href="/url">texto</a>

Páginas disponíveis (escolha as mais relevantes ao tema):
/sistema-para-gestao-de-clientes, /sistema-para-gestao-de-fornecedores, /sistema-para-gestao-de-estoque
/sistema-para-contas-a-pagar, /sistema-para-contas-a-receber, /sistema-para-controle-de-inadimplencia
/sistema-para-fluxo-de-caixa, /sistema-ordem-servico
/software-gestao-oficina-mecanica, /funilaria
/sistema-para-barbearia, /sistema-para-salao-de-beleza, /sistema-para-clinica-estetica
/sistema-para-loja-de-roupas, /sistema-para-pet-shop, /sistema-para-pizzaria, /sistema-para-lava-rapido
/beneficios, /demonstracao, /faq, /assinatura-digital

══════════════════════════════════════
📤 FORMATO DE SAÍDA (OBRIGATÓRIO)
══════════════════════════════════════

TÍTULO: [título até 60 caracteres com palavra-chave no início]
EXCERPT: [resumo 2-3 frases]
CONTEÚDO: [HTML completo com estrutura semântica, backlinks internos, listas, tabelas, exemplos práticos]
META_TITLE: [até 60 caracteres]
META_DESCRIPTION: [até 155 caracteres]
META_KEYWORDS: [5-10 palavras-chave separadas por vírgula]
FEATURED_SNIPPET: [40-60 palavras, resposta direta]
AI_SUMMARY_1: [ponto objetivo 1]
AI_SUMMARY_2: [ponto objetivo 2]
AI_SUMMARY_3: [ponto objetivo 3]
AI_SUMMARY_4: [ponto objetivo 4 - opcional]
AI_SUMMARY_5: [ponto objetivo 5 - opcional]
FAQ_Q1: [pergunta 1]
FAQ_A1: [resposta 1 - até 50 palavras]
FAQ_Q2: [pergunta 2]
FAQ_A2: [resposta 2 - até 50 palavras]
FAQ_Q3: [pergunta 3]
FAQ_A3: [resposta 3 - até 50 palavras]
FAQ_Q4: [pergunta 4 - opcional]
FAQ_A4: [resposta 4 - até 50 palavras - opcional]
FAQ_Q5: [pergunta 5 - opcional]
FAQ_A5: [resposta 5 - até 50 palavras - opcional]
DISCOVER_CONTEXT: [Por que isso é importante agora? 2-3 frases com relevância temporal]
DISCOVER_IMAGE_PROMPT: [descrição curta para imagem flat, horizontal 1200x628, poucos elementos, fundo limpo, máx 5 palavras se houver texto]
INTERNAL_LINK_1_URL: [url sem barra inicial, ex: sistema-ordem-servico]
INTERNAL_LINK_1_TEXT: [texto âncora]
INTERNAL_LINK_2_URL: [url]
INTERNAL_LINK_2_TEXT: [texto âncora]
INTERNAL_LINK_3_URL: [url]
INTERNAL_LINK_3_TEXT: [texto âncora]

NUNCA explique o processo. NUNCA faça comentários técnicos. Entregue SOMENTE o conteúdo otimizado no formato acima.
PROMPT;
    }

    private function parseResponse(
        string $content,
        string $fallbackTitle,
        ?BlogCategory $category,
        ?User $author,
    ): array {
        $lines = explode("\n", $content);
        $data = [
            'title' => '',
            'excerpt' => '',
            'content' => '',
            'meta_title' => '',
            'meta_description' => '',
            'meta_keywords' => '',
            'featured_snippet' => '',
            'ai_summary' => [],
            'faq' => [],
            'discover_context' => '',
            'discover_image_prompt' => '',
            'internal_links_suggestions' => [],
            'category_id' => $category->id ?? null,
            'author_id' => $author->id ?? auth()->id(),
            'status' => 'draft',
        ];

        $currentSection = null;
        $contentLines = [];
        $faqTemp = [];

        foreach ($lines as $line) {
            $line = mb_trim($line);

            if (str_starts_with($line, 'TÍTULO:')) {
                $data['title'] = mb_trim(mb_substr($line, 7));

                continue;
            }

            if (str_starts_with($line, 'EXCERPT:')) {
                $data['excerpt'] = mb_trim(mb_substr($line, 8));

                continue;
            }

            if (str_starts_with($line, 'CONTEÚDO:')) {
                $currentSection = 'content';
                $contentLines = [];

                continue;
            }

            if (str_starts_with($line, 'META_TITLE:')) {
                $data['meta_title'] = mb_trim(mb_substr($line, 11));
                $currentSection = null;

                continue;
            }

            if (str_starts_with($line, 'META_DESCRIPTION:')) {
                $data['meta_description'] = mb_trim(mb_substr($line, 17));
                $currentSection = null;

                continue;
            }

            if (str_starts_with($line, 'META_KEYWORDS:')) {
                $data['meta_keywords'] = mb_trim(mb_substr($line, 14));
                $currentSection = null;

                continue;
            }

            if (str_starts_with($line, 'FEATURED_SNIPPET:')) {
                $data['featured_snippet'] = mb_trim(mb_substr($line, 17));
                $currentSection = null;

                continue;
            }

            // AI Summary parsing
            if (preg_match('/^AI_SUMMARY_(\d+):\s*(.+)$/', $line, $matches)) {
                $data['ai_summary'][] = ['point' => mb_trim($matches[2])];
                $currentSection = null;

                continue;
            }

            // FAQ parsing
            if (preg_match('/^FAQ_Q(\d+):\s*(.+)$/', $line, $matches)) {
                $index = (int) $matches[1] - 1;
                $faqTemp[$index]['question'] = mb_trim($matches[2]);
                $currentSection = null;

                continue;
            }

            if (preg_match('/^FAQ_A(\d+):\s*(.+)$/', $line, $matches)) {
                $index = (int) $matches[1] - 1;
                $faqTemp[$index]['answer'] = mb_trim($matches[2]);
                $currentSection = null;

                continue;
            }

            if (str_starts_with($line, 'DISCOVER_CONTEXT:')) {
                $data['discover_context'] = mb_trim(mb_substr($line, 17));
                $currentSection = null;

                continue;
            }

            if (str_starts_with($line, 'DISCOVER_IMAGE_PROMPT:')) {
                $data['discover_image_prompt'] = mb_trim(mb_substr($line, 22));
                $currentSection = null;

                continue;
            }

            // Internal links parsing
            if (preg_match('/^INTERNAL_LINK_(\d+)_URL:\s*(.+)$/', $line, $matches)) {
                $index = (int) $matches[1] - 1;
                $url = mb_trim($matches[2]);
                // Garante que a URL não tenha barra inicial
                $data['internal_links_suggestions'][$index]['url'] = mb_ltrim($url, '/');
                $currentSection = null;

                continue;
            }

            if (preg_match('/^INTERNAL_LINK_(\d+)_TEXT:\s*(.+)$/', $line, $matches)) {
                $index = (int) $matches[1] - 1;
                $data['internal_links_suggestions'][$index]['anchor_text'] = mb_trim($matches[2]);
                $currentSection = null;

                continue;
            }

            if ($currentSection === 'content' && $line !== '') {
                $contentLines[] = $line;
            }
        }

        // Reorganiza FAQ para array indexado
        ksort($faqTemp);
        foreach ($faqTemp as $item) {
            if (isset($item['question']) && isset($item['answer'])) {
                $data['faq'][] = $item;
            }
        }

        // Reorganiza internal links para array indexado
        $tempLinks = $data['internal_links_suggestions'];
        $data['internal_links_suggestions'] = [];
        ksort($tempLinks);
        foreach ($tempLinks as $link) {
            if (isset($link['url']) && isset($link['anchor_text'])) {
                $data['internal_links_suggestions'][] = $link;
            }
        }

        $data['content'] = $this->cleanContent(implode("\n", $contentLines));

        if (empty($data['title'])) {
            $data['title'] = $fallbackTitle;
        }

        $data['slug'] = BlogPost::generateUniqueSlug($data['title']);

        if (empty($data['meta_title'])) {
            $data['meta_title'] = Str::limit($data['title'], 60);
        }

        if (empty($data['meta_description'])) {
            $data['meta_description'] = Str::limit(
                strip_tags($data['excerpt'] ?: $data['content']),
                160
            );
        }

        if (empty($data['meta_keywords'])) {
            $data['meta_keywords'] = implode(', ', array_slice(
                array_filter(
                    explode(' ', Str::lower($data['title'])),
                    fn ($word) => mb_strlen($word) > 3
                ),
                0,
                5
            ));
        }

        return $data;
    }

    private function parseSEOMetadata(string $content): array
    {
        $lines = explode("\n", $content);
        $data = [
            'meta_title' => '',
            'meta_description' => '',
            'og_image_suggestion' => '',
            'keywords' => '',
        ];

        foreach ($lines as $line) {
            $line = mb_trim($line);

            if (str_starts_with($line, 'META_TITLE:')) {
                $data['meta_title'] = mb_trim(mb_substr($line, 11));
            } elseif (str_starts_with($line, 'META_DESCRIPTION:')) {
                $data['meta_description'] = mb_trim(mb_substr($line, 17));
            } elseif (str_starts_with($line, 'OG_IMAGE_SUGGESTION:')) {
                $data['og_image_suggestion'] = mb_trim(mb_substr($line, 20));
            } elseif (str_starts_with($line, 'KEYWORDS:')) {
                $data['keywords'] = mb_trim(mb_substr($line, 9));
            }
        }

        return $data;
    }

    private function cleanContent(string $content): string
    {
        $content = mb_trim($content);

        // Remove marcadores de bloco de código markdown (```html, ```xml, ``` no início)
        $content = preg_replace('/^```(?:html|xml|htm)?\s*/i', '', $content);

        // Remove marcador de fechamento de bloco de código (``` no final)
        $content = preg_replace('/\s*```\s*$/', '', $content);

        return mb_trim($content);
    }

    /**
     * Gera uma imagem usando OpenAI DALL-E 3
     *
     * @param  string  $prompt  Descrição da imagem a ser gerada
     * @param  string  $title  Título do post (usado para nome do arquivo)
     * @return string|null Caminho da imagem salva ou null se falhar
     *
     * @throws Exception
     */
    public function generateImage(string $prompt, string $title): ?string
    {
        try {
            // Otimiza o prompt para DALL-E
            $optimizedPrompt = $this->optimizeImagePrompt($prompt);

            // Gera a imagem com DALL-E 3
            $response = OpenAI::images()->create([
                'model' => 'dall-e-3',
                'prompt' => $optimizedPrompt,
                'n' => 1,
                'size' => '1792x1024', // Formato horizontal otimizado
                'quality' => 'standard', // ou 'hd' para maior qualidade
                'response_format' => 'url',
            ]);

            $imageUrl = $response->data[0]->url ?? null;

            if (! $imageUrl) {
                throw new Exception('URL da imagem não retornada pela API');
            }

            // Download da imagem
            $imageContent = Http::timeout(30)->get($imageUrl)->body();

            if (empty($imageContent)) {
                throw new Exception('Falha ao fazer download da imagem gerada');
            }

            // Gera nome único para o arquivo
            $filename = Str::slug($title).'-'.time().'.png';
            $path = 'blog/featured/'.$filename;

            // Salva no storage público
            Storage::disk('public')->put($path, $imageContent);

            return $path;
        } catch (Exception $e) {
            // Re-lança a exceção para tratamento no método chamador
            throw new Exception('Erro ao gerar imagem: '.$e->getMessage());
        }
    }

    /**
     * Otimiza o prompt para geração de imagem DALL-E
     * Garante que a imagem seja adequada para Google Discover
     */
    private function optimizeImagePrompt(string $prompt): string
    {
        // Se o prompt já estiver bem formatado, usa como está
        if (str_word_count($prompt) > 10) {
            return $prompt;
        }

        // Adiciona contexto para melhor qualidade
        $enhancedPrompt = $prompt;

        // Garante estilo flat design e profissional
        if (! str_contains(mb_strtolower($prompt), 'flat')) {
            $enhancedPrompt .= ', flat design style';
        }

        if (! str_contains(mb_strtolower($prompt), 'professional')) {
            $enhancedPrompt .= ', professional and modern';
        }

        // Garante cores vibrantes para Discover
        if (! str_contains(mb_strtolower($prompt), 'color')) {
            $enhancedPrompt .= ', vibrant colors';
        }

        // Adiciona orientações técnicas
        $enhancedPrompt .= ', high quality, no text overlay, clean composition';

        return $enhancedPrompt;
    }
}
