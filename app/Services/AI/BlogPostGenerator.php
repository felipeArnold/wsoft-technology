<?php

declare(strict_types=1);

namespace App\Services\AI;

use App\Models\Blog\BlogCategory;
use App\Models\Blog\BlogPost;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;
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

        return $this->parseResponse($content, $topic, $category, $author);
    }

    public function generateMultiplePosts(
        array $topics,
        ?BlogCategory $category = null,
        ?User $author = null,
        string $tone = 'profissional',
        int $wordCount = 1000,
    ): array {
        $posts = [];

        foreach ($topics as $index => $topic) {
            $posts[] = $this->generatePost($topic, $category, $author, $tone, $wordCount);

            // Adiciona delay entre requisições para evitar rate limit (exceto no último)
            if ($index < count($topics) - 1) {
                sleep($this->retryDelaySeconds);
            }
        }

        return $posts;
    }

    public function improveExistingPost(BlogPost $post): array
    {
        $prompt = <<<PROMPT
⚠️ ATENÇÃO - REQUISITO CRÍTICO DE BACKLINKS:
Você DEVE incluir NO MÍNIMO 3 backlinks internos no conteúdo HTML usando as páginas listadas abaixo.
Formato obrigatório: <a href="/url">texto descritivo</a>
Sem backlinks = tarefa incompleta e inaceitável.

Páginas OBRIGATÓRIAS para backlinks (escolha as mais relevantes ao tópico):
- /sistema-para-gestao-de-clientes, /sistema-para-gestao-de-fornecedores, /sistema-para-gestao-de-estoque
- /sistema-para-contas-a-pagar, /sistema-para-contas-a-receber, /sistema-para-controle-de-inadimplencia
- /sistema-para-fluxo-de-caixa, /sistema-ordem-servico
- /software-gestao-oficina-mecanica, /funilaria
- /sistema-para-barbearia, /sistema-para-salao-de-beleza, /sistema-para-clinica-estetica
- /sistema-para-loja-de-roupas, /sistema-para-pet-shop, /sistema-para-pizzaria, /sistema-para-lava-rapido
- /beneficios, /demonstracao, /faq, /assinatura-digital

Exemplo: "É essencial ter um <a href="/sistema-ordem-servico">sistema de ordem de serviço</a> eficiente."

Analise e melhore o seguinte post de blog. Mantenha o mesmo tema e estrutura, mas:
1. Melhore a qualidade do texto
2. Adicione mais detalhes e exemplos relevantes
3. Otimize para SEO
4. Torne o conteúdo mais envolvente
5. ADICIONE NO MÍNIMO 3 BACKLINKS INTERNOS (conforme lista acima)

Título atual: {$post->title}
Conteúdo atual: {$post->content}

Forneça uma versão melhorada no formato:
TÍTULO: [novo título]
EXCERPT: [novo resumo]
CONTEÚDO: [novo conteúdo em HTML com backlinks internos]
META_TITLE: [título SEO]
META_DESCRIPTION: [descrição SEO]
META_KEYWORDS: [palavras-chave separadas por vírgula]
PROMPT;

        $response = $this->makeOpenAIRequest(
            messages: [
                [
                    'role' => 'system',
                    'content' => 'Você é um editor profissional especializado em melhorar conteúdo de blog em português brasileiro. CRÍTICO: Você DEVE incluir NO MÍNIMO 3 backlinks internos no formato <a href="/url">texto</a> em TODOS os posts. Isso não é opcional.',
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

        return $this->parseResponse($content, $post->title, $category, $author);
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
Crie um post de blog completo e de alta qualidade sobre o seguinte tópico:

TÓPICO: {$topic}
{$categoryContext}TOM: {$tone}
EXTENSÃO: Aproximadamente {$wordCount} palavras

⚠️ ATENÇÃO - REQUISITO CRÍTICO DE BACKLINKS:
Você DEVE incluir NO MÍNIMO 3 backlinks internos no conteúdo HTML usando as páginas listadas abaixo.
Formato obrigatório: <a href="/url">texto descritivo</a>
Sem backlinks = tarefa incompleta e inaceitável.

Páginas OBRIGATÓRIAS para backlinks (escolha as mais relevantes ao tópico):
- /sistema-para-gestao-de-clientes
- /sistema-para-gestao-de-fornecedores
- /sistema-para-gestao-de-estoque
- /sistema-para-contas-a-pagar
- /sistema-para-contas-a-receber
- /sistema-para-controle-de-inadimplencia
- /sistema-para-fluxo-de-caixa
- /sistema-ordem-servico
- /software-gestao-oficina-mecanica
- /funilaria
- /sistema-para-barbearia
- /sistema-para-salao-de-beleza
- /sistema-para-clinica-estetica
- /sistema-para-loja-de-roupas
- /sistema-para-pet-shop
- /sistema-para-pizzaria
- /sistema-para-lava-rapido
- /beneficios
- /demonstracao
- /faq
- /assinatura-digital

O post deve incluir:
1. Um título atraente e otimizado para SEO
2. Um resumo/excerpt convincente (2-3 frases)
3. Conteúdo principal bem estruturado em HTML com:
   - Introdução engajadora
   - Subtítulos (h2, h3) para organizar o conteúdo
   - Parágrafos bem escritos
   - Listas quando apropriado
   - NO MÍNIMO 3 backlinks internos (conforme requisito acima)
   - Conclusão impactante
4. Meta título para SEO (máximo 60 caracteres)
5. Meta descrição para SEO (máximo 160 caracteres)
6. Palavras-chave relevantes para SEO (5-10 palavras-chave separadas por vírgula)

Exemplo de backlink correto no conteúdo:
"Para uma gestão eficiente, é fundamental contar com um <a href="/sistema-ordem-servico">sistema de ordem de serviço</a> moderno que centralize todas as informações."

Forneça a resposta no seguinte formato:
TÍTULO: [título do post]
EXCERPT: [resumo do post]
CONTEÚDO: [conteúdo completo em HTML com backlinks internos]
META_TITLE: [título SEO]
META_DESCRIPTION: [descrição SEO]
META_KEYWORDS: [palavras-chave separadas por vírgula]
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
            'category_id' => $category->id ?? null,
            'author_id' => $author->id ?? auth()->id(),
            'status' => 'draft',
        ];

        $currentSection = null;
        $contentLines = [];

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

            if ($currentSection === 'content' && $line !== '') {
                $contentLines[] = $line;
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
            // Gera keywords básicas baseadas no título se não houver
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
}
