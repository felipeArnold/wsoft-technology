# Geração Automática de Posts com IA

Este documento descreve como usar o sistema de geração automática de posts de blog utilizando a API da OpenAI.

## Configuração Inicial

### 1. Configurar a Chave da API OpenAI

Edite o arquivo `.env` e adicione sua chave da API OpenAI:

```env
OPENAI_API_KEY=sk-sua-chave-aqui
```

Para obter uma chave da API:
1. Acesse [https://platform.openai.com/api-keys](https://platform.openai.com/api-keys)
2. Crie uma nova chave de API
3. Copie e cole no arquivo `.env`

### 2. Verificar Instalação

O pacote `openai-php/laravel` já está instalado. Você pode verificar executando:

```bash
composer show openai-php/laravel
```

## Funcionalidades Disponíveis

### 1. Geração Rápida com Tema (RECOMENDADO)

A forma mais rápida e simples de gerar conteúdo:

1. Acesse **Blog > Posts do Blog** e clique em **"Criar"** (ou edite um post existente)
2. No topo do formulário, você verá a seção **"Gerador de Conteúdo com IA"**
3. Digite o tema do post no campo (ex: "Como melhorar a gestão financeira da sua empresa")
4. Clique no botão **"Gerar"** ao lado do campo
5. Confirme a geração
6. Aguarde alguns segundos e todos os campos serão preenchidos automaticamente:
   - Título otimizado
   - Slug único
   - Conteúdo completo em HTML
   - Resumo/excerpt
   - Meta título SEO
   - Meta descrição SEO
7. Revise o conteúdo e clique em **"Salvar"**

**Dica:** Selecione a categoria antes de gerar o conteúdo para que a IA adapte o texto ao contexto da categoria.

### 2. Gerar Post Individual (Modal)

Alternativa via modal no painel administrativo:

Acesse **Blog > Posts do Blog** e clique no botão **"Gerar Post com IA"** no topo da lista.

**Parâmetros:**
- **Tópico do Post**: Descrição do assunto principal (ex: "Como melhorar a gestão financeira")
- **Categoria**: Categoria opcional do blog
- **Tom do Conteúdo**: Profissional, Casual, Técnico ou Educativo
- **Tamanho do Post**: 500, 1000, 1500 ou 2000 palavras

**Resultado:**
- Post criado como rascunho
- Título otimizado para SEO
- Conteúdo em HTML bem estruturado
- Excerpt/resumo atraente
- Meta tags SEO (título e descrição)
- Slug único gerado automaticamente

### 2. Gerar Múltiplos Posts

Clique no botão **"Gerar Múltiplos Posts"** para criar vários posts de uma vez.

**Como usar:**
1. Digite cada tópico em uma linha separada
2. Selecione a categoria (opcional)
3. Escolha o tom e tamanho
4. Clique em "Gerar Posts"

**Exemplo:**
```
Gestão financeira para pequenas empresas
Dicas de controle de estoque
Como reduzir custos operacionais
Estratégias de marketing digital
```

### 3. Melhorar Post Existente

Ao editar um post, você tem acesso a duas ações com IA:

#### a) Melhorar com IA
Clique no botão **"Melhorar com IA"** para:
- Aprimorar a qualidade do texto
- Adicionar mais detalhes e exemplos
- Otimizar para SEO
- Tornar o conteúdo mais envolvente

**Importante:** As mudanças serão carregadas no formulário, mas não salvas automaticamente. Revise e clique em "Salvar" se aprovar.

#### b) Gerar SEO com IA
Clique em **"Gerar SEO com IA"** para:
- Criar meta título otimizado (máx 60 caracteres)
- Criar meta descrição otimizada (máx 160 caracteres)
- Baseado no conteúdo atual do post

## Uso Programático

### Exemplo 1: Gerar um Post

```php
use App\Services\AI\BlogPostGenerator;
use App\Models\Blog\BlogCategory;

$generator = app(BlogPostGenerator::class);

$postData = $generator->generatePost(
    topic: 'Como melhorar a produtividade no trabalho',
    category: BlogCategory::where('slug', 'produtividade')->first(),
    author: auth()->user(),
    tone: 'profissional',
    wordCount: 1000,
);

$post = BlogPost::create($postData);
```

### Exemplo 2: Gerar Múltiplos Posts

```php
$topics = [
    'Tendências de tecnologia em 2025',
    'Ferramentas de automação para empresas',
    'Como implementar IA no seu negócio',
];

$posts = $generator->generateMultiplePosts(
    topics: $topics,
    category: $category,
    tone: 'técnico',
    wordCount: 1500,
);

foreach ($posts as $postData) {
    BlogPost::create($postData);
}
```

### Exemplo 3: Melhorar Post Existente

```php
$post = BlogPost::find(1);

$improvedData = $generator->improveExistingPost($post);

$post->update($improvedData);
```

### Exemplo 4: Gerar Apenas Metadados SEO

```php
$seoData = $generator->generateSEOMetadata(
    title: $post->title,
    content: $post->content,
);

$post->update([
    'meta_title' => $seoData['meta_title'],
    'meta_description' => $seoData['meta_description'],
]);

// Dados adicionais disponíveis:
// $seoData['og_image_suggestion'] - sugestão de tipo de imagem
// $seoData['keywords'] - palavras-chave sugeridas
```

## Modelo Utilizado

O sistema utiliza o modelo **GPT-4o Mini** da OpenAI, que oferece:
- Excelente qualidade de conteúdo
- Respostas rápidas
- Custo reduzido comparado ao GPT-4

## Custos Estimados

Baseado nos preços da OpenAI (verificar preços atuais em [https://openai.com/pricing](https://openai.com/pricing)):

- **Post curto (500 palavras)**: ~$0.01 - $0.02
- **Post médio (1000 palavras)**: ~$0.02 - $0.04
- **Post longo (1500 palavras)**: ~$0.03 - $0.06
- **Post muito longo (2000 palavras)**: ~$0.04 - $0.08

## Boas Práticas

1. **Sempre revise o conteúdo gerado** antes de publicar
2. **Personalize os posts** adicionando sua experiência e exemplos específicos
3. **Verifique fatos e estatísticas** mencionados pela IA
4. **Adicione imagens relevantes** aos posts gerados
5. **Use categorias apropriadas** para melhor organização
6. **Teste diferentes tons** para ver qual funciona melhor com seu público

## Troubleshooting

### Erro: "Maximum execution time exceeded"
O sistema está configurado para lidar com requisições longas:
- **Timeout da API OpenAI**: 120 segundos (2 minutos)
- **Timeout PHP**: Aumentado automaticamente para 180 segundos (3 minutos) durante requisições

**Se ainda assim ocorrer timeout:**
1. **Reduza o tamanho do post**: Use 500 ou 1000 palavras ao invés de 1500-2000
2. **Verifique sua conexão**: Conexões lentas podem causar timeouts
3. **Aumente o timeout no `.env`**:
   ```env
   OPENAI_REQUEST_TIMEOUT=300  # 5 minutos
   ```
4. **Execute `php artisan config:clear`** após alterar o `.env`

### Erro: "Invalid API Key"
- Verifique se a chave da API está correta no `.env`
- Execute `php artisan config:clear` para limpar o cache

### Erro: "Rate limit exceeded" ou "Limite de requisições excedido"
O sistema já implementa **retry automático com delay** para lidar com rate limits:
- **3 tentativas automáticas** com delays progressivos (2s, 4s, 6s)
- Se ainda assim falhar, você verá uma mensagem clara com link para verificar sua cota

**Soluções:**
1. **Aguarde alguns minutos** - Os limites da OpenAI são por minuto/hora
2. **Verifique sua cota em** [platform.openai.com/usage](https://platform.openai.com/usage)
3. **Para múltiplos posts**: O sistema adiciona delay automático de 2 segundos entre cada post
4. **Considere upgrade do plano** na OpenAI se precisar de mais requisições/minuto

### Conteúdo gerado está incompleto
- Aumente o `max_completion_tokens` no `BlogPostGenerator.php`
- Considere reduzir o `wordCount` solicitado

### Conteúdo está em outro idioma
- O sistema está configurado para gerar conteúdo em português brasileiro
- Se persistir, edite o prompt do sistema em `BlogPostGenerator.php`

## Estrutura de Arquivos

```
app/
├── Services/
│   └── AI/
│       └── BlogPostGenerator.php       # Serviço principal de geração
├── Filament/
│   └── Admin/
│       └── Resources/
│           └── Blog/
│               └── BlogPostResource/
│                   └── Pages/
│                       ├── ListBlogPosts.php   # Ações de geração
│                       └── EditBlogPost.php    # Ações de melhoria
└── Models/
    └── Blog/
        └── BlogPost.php                # Model do post

config/
└── openai.php                          # Configuração do OpenAI

.env                                     # Chave da API
```

## Próximos Passos

Possíveis melhorias futuras:
- Geração de imagens com DALL-E
- Agendamento automático de posts
- Análise de tendências para sugerir tópicos
- Tradução automática para outros idiomas
- Integração com redes sociais para compartilhamento
- Geração de newsletters a partir de posts
