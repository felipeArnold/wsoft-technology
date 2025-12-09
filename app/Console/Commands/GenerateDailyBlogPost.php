<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Blog\BlogCategory;
use App\Models\Blog\BlogPost;
use App\Models\User;
use App\Services\AI\BlogPostGenerator;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

final class GenerateDailyBlogPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:generate-daily
                            {--category= : ID da categoria do blog}
                            {--author= : ID do autor do post}
                            {--publish : Publicar automaticamente (padrão: rascunho)}
                            {--topic= : Tópico específico para gerar}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gera automaticamente um post de blog sobre funcionalidades do SaaS para atrair leads';

    /**
     * Tópicos relevantes sobre funcionalidades do SaaS
     * Organizados para gerar conteúdo educativo e atrair leads qualificados
     */
    private array $topics = [
        // Gestão de Vendas & Pipeline
        'Como aumentar suas vendas em 40% com um sistema de CRM eficiente',
        '7 estratégias comprovadas para atingir suas metas de vendas todo mês',
        'Funil de vendas: Guia completo para otimizar cada etapa e vender mais',
        'Automação de vendas: 10 tarefas que você pode automatizar hoje',
        'Pipeline de vendas previsível: Como criar e manter sua máquina de vendas',
        'Técnicas de prospecção que realmente funcionam em 2025',
        'Vendas consultivas: Como vender valor ao invés de preço',
        'Ciclo de vendas longo: Estratégias para encurtar e fechar mais negócios',
        'Inside sales vs. Field sales: Qual modelo adotar na sua empresa',
        'Account-based selling: Estratégia para conquistar grandes contas',

        // Gestão Financeira & Cobrança
        'Gestão de contas a receber: Como garantir fluxo de caixa saudável',
        'Inadimplência zero: 8 estratégias inteligentes de cobrança que funcionam',
        'Controle financeiro para PMEs: Guia prático em 7 passos',
        'KPIs financeiros essenciais: 12 indicadores que todo gestor deve acompanhar',
        'Previsão de receita: Como criar forecasts precisos e confiáveis',
        'Capital de giro: Como calcular e otimizar para seu negócio',
        'DRE Gerencial: Como usar para tomar decisões estratégicas',
        'Pricing estratégico: Como precificar seus produtos e serviços corretamente',
        'Análise de margem de contribuição: Descubra quais produtos geram mais lucro',
        'Gestão de despesas operacionais: Onde cortar custos sem prejudicar o negócio',

        // Produtividade & Automação
        'Gestão de equipes remotas: 10 práticas para manter a produtividade',
        'Dashboard gerencial: Como criar painéis que realmente apoiam decisões',
        'Automação de processos: Elimine 80% das tarefas manuais da sua empresa',
        'Integração entre sistemas: Como conectar suas ferramentas e ganhar eficiência',
        'Relatórios gerenciais: Os 5 relatórios essenciais para qualquer negócio',
        'Gestão do tempo comercial: Como seu time pode vender 50% mais',
        'Reuniões produtivas: Como conduzir reuniões de vendas que geram resultados',
        'Workflow de aprovação: Como agilizar decisões na sua empresa',
        'Documentação de processos: Por que e como fazer na prática',
        'Gestão ágil aplicada a vendas: Sprints, daily e retrospectivas comerciais',

        // CRM & Relacionamento com Clientes
        'CRM para pequenas empresas: ROI comprovado e como implementar',
        'Customer 360: Como ter visão completa do cliente em um só lugar',
        'Histórico de interações: Por que cada conversa com cliente vale ouro',
        'Follow-up estratégico: A ciência por trás do timing perfeito',
        'Segmentação avançada: Como personalizar abordagem por perfil de cliente',
        'Retenção de clientes: 9 estratégias para reduzir churn e aumentar LTV',
        'Upsell e cross-sell: Como vender mais para clientes atuais',
        'NPS e satisfação: Como medir e melhorar a experiência do cliente',
        'Onboarding de clientes: Primeiros 90 dias que definem o sucesso',
        'Customer success: Como garantir que seus clientes tenham resultado',

        // Metas, KPIs & Performance
        'Como definir metas SMART que sua equipe vai realmente alcançar',
        'OKRs para vendas: Implementação prática com exemplos reais',
        'Acompanhamento de metas em tempo real: Dashboards que motivam',
        'Gamificação comercial: Como motivar vendedores com competições saudáveis',
        'Planejamento comercial 2025: Template completo passo a passo',
        'Comissionamento de vendas: Modelos que alinham objetivos e resultados',
        'Performance individual vs. time: Como equilibrar metas e recompensas',
        'Métricas de produtividade: Atividade vs. resultado em vendas',
        'Forecast de vendas: Como criar previsões precisas mês a mês',
        'Análise de conversão: Como identificar e corrigir gargalos no funil',

        // Tecnologia, IA & Inovação
        'Transformação digital: Roadmap completo para empresas tradicionais',
        'Cloud vs. On-premise: Qual escolher para seu sistema de gestão',
        'IA em vendas: 12 aplicações práticas que já estão funcionando',
        'Chatbots e automação: Como atender clientes 24/7 sem contratar',
        'Como escolher o software de gestão perfeito: Checklist em 20 itens',
        'Migração de Excel para sistema: Guia completo sem trauma',
        'API e integrações: Como conectar sistemas e eliminar retrabalho',
        'Business Intelligence: Como transformar dados em insights acionáveis',
        'Machine Learning em vendas: Previsão de churn e oportunidades',
        'Segurança de dados: LGPD e boas práticas em sistemas de gestão',

        // Crescimento, Escala & Expansão
        'Como escalar de 100 para 1000 clientes mantendo qualidade',
        'Processos escaláveis: Como padronizar para crescer sem caos',
        'Hora de investir em sistema: 15 sinais que sua empresa está pronta',
        'Crescimento de 10x: Framework completo para empresas ambiciosas',
        'Gestão multi-unidades: Como controlar filiais de forma centralizada',
        'Expansão geográfica: Como estruturar vendas em diferentes regiões',
        'Franchising: Como sistemas de gestão viabilizam expansão por franquias',
        'Escalabilidade de equipe: Como contratar e treinar vendedores rapidamente',
        'De startup a scaleup: Desafios de gestão em cada fase',
        'Preparação para investimento: Como organizar sua empresa para receber aporte',

        // Marketing, Leads & Conversão
        'Geração de leads B2B: 15 estratégias que trazem oportunidades qualificadas',
        'Marketing de conteúdo para SaaS: Como atrair e converter',
        'Lead scoring: Como priorizar contatos com maior chance de fechar',
        'Nutrição de leads: Sequências de email que convertem',
        'Inbound sales: Como vender para leads que chegam pelo marketing',
        'Social selling: Como usar LinkedIn para prospectar e fechar vendas',
        'Remarketing estratégico: Como reconquistar leads que esfriaram',
        'Funil de marketing + vendas: Alinhamento perfeito entre os times',
        'CAC e LTV: Como calcular e otimizar o custo de aquisição',
        'Growth hacking para B2B: Táticas de crescimento acelerado',

        // Atendimento & Suporte
        'Atendimento ao cliente de excelência: Práticas das empresas líderes',
        'Suporte multicanal: Como atender bem no WhatsApp, email e telefone',
        'SLA e tempo de resposta: Como estabelecer e cumprir promessas',
        'Base de conhecimento: Como criar FAQ que realmente ajuda',
        'Escalação de problemas: Fluxo eficiente para resolver casos complexos',
        'CSAT e qualidade: Como medir e melhorar atendimento continuamente',
        'Autoatendimento: Como reduzir tickets em 60% com self-service',
        'Chatbot de suporte: Quando vale a pena implementar',
        'Gestão de reclamações: Como transformar clientes insatisfeitos em promotores',
        'Treinamento de atendimento: Como capacitar equipe para encantar',

        // Vendas B2B & Enterprise
        'Vendas B2B complexas: Estratégias para ciclos longos e múltiplos decisores',
        'Proof of concept (POC): Como estruturar para maximizar conversão',
        'Negociação B2B: Técnicas para fechar contratos enterprise',
        'Compras corporativas: Como navegar processos de procurement',
        'Contratos e SLA: Como estruturar acordos enterprise',
        'Account management: Como gerenciar grandes contas estratégicas',
        'Vendas consultivas B2B: Da prospecção ao pós-venda',
        'RFP e licitações: Como responder e vencer concorrências',
        'Parcerias estratégicas: Como criar canais de revenda B2B',
        'Vendas complexas: SPIN selling, Challenger sale e outras metodologias',

        // Análise de Dados & Inteligência
        'Data-driven sales: Como usar dados para vender mais e melhor',
        'Análise de coorte: Entenda o comportamento de clientes ao longo do tempo',
        'Churn analysis: Como identificar padrões de cancelamento',
        'Análise preditiva: Preveja vendas e comportamentos com dados históricos',
        'Excel vs. BI: Quando é hora de evoluir sua análise de dados',
        'Google Data Studio para vendas: Dashboards gratuitos e poderosos',
        'ETL e integração de dados: Como consolidar informações de múltiplas fontes',
        'Análise de funil: Diagnóstico completo da jornada de vendas',
        'Cohort retention: Como medir retenção por grupo de clientes',
        'Data warehouse para PMEs: Vale a pena investir?',

        // Mobile & Acesso Remoto
        'CRM mobile: Como vender em movimento com app no celular',
        'Gestão remota: Como controlar negócio de qualquer lugar',
        'Vendas field: Apps essenciais para vendedores externos',
        'Offline first: Como trabalhar sem internet e sincronizar depois',
        'QR Code e NFC: Tecnologias mobile aplicadas a vendas',
        'Assinatura digital: Como fechar contratos 100% online',
        'Geolocalização em vendas: Como rastrear equipe externa',
        'BYOD (Bring Your Own Device): Política de uso de dispositivos pessoais',
        'Aplicativos white label: Quando criar app próprio para clientes',
        'Progressive Web Apps: Alternativa mobile sem desenvolver app nativo',

        // Estratégia & Gestão Executiva
        'Estratégia comercial: Como criar plano de vendas vencedor',
        'Gestão à vista: Como usar painéis físicos e digitais para engajar equipe',
        'Cultura de vendas: Como criar mentalidade de alta performance',
        'Turnover em vendas: Como reduzir rotatividade e reter talentos',
        'Compensação variável: Estruturas de comissão que funcionam',
        'Sales enablement: Como equipar vendedores para ter sucesso',
        'Playbook de vendas: Como documentar e replicar sucesso',
        'Win/Loss analysis: Aprenda com vendas ganhas e perdidas',
        'Território de vendas: Como dividir geograficamente ou por segmento',
        'Sales operations: Como estruturar operações comerciais eficientes',

        // Casos de Uso, ROI & Decisão
        'ROI de CRM: Como calcular retorno em 12 meses ou menos',
        '10 sinais críticos de que sua empresa precisa de CRM agora',
        'Sistema de gestão salvou estas 5 empresas da crise: Cases reais',
        'Erros fatais em gestão comercial: Como evitar os 12 principais',
        'Benchmarking comercial: Compare sua empresa com média do mercado',
        'CRM vs. planilhas: Comparação honesta com prós e contras',
        'Implementação de sistema: Timeline realista do projeto à produção',
        'Change management: Como fazer equipe adotar novo sistema',
        'Migração de sistema: Checklist completo para transição sem dor',
        'Sistema customizado vs. SaaS: Quando cada um faz sentido',
    ];

    public function handle(BlogPostGenerator $generator): int
    {
        $this->info('🚀 Iniciando geração de post de blog diário...');

        try {
            // Obtém ou seleciona categoria
            $category = $this->getCategory();

            // Obtém ou seleciona autor
            $author = $this->getAuthor();

            // Seleciona tópico
            $topic = $this->selectTopic();

            if (! $topic) {
                $this->error('❌ Não foi possível selecionar um tópico.');

                return Command::FAILURE;
            }

            $this->info("📝 Tópico selecionado: {$topic}");
            $this->info('⏳ Gerando conteúdo com IA (isso pode levar alguns minutos)...');

            // Gera o post
            $postData = $generator->generatePost(
                topic: $topic,
                category: $category,
                author: $author,
                tone: 'profissional e educativo',
                wordCount: 1200
            );

            // Define status baseado na opção --publish
            $postData['status'] = $this->option('publish') ? 'published' : 'draft';
            $postData['published_at'] = $this->option('publish') ? now() : null;

            // Salva o post
            $post = BlogPost::create($postData);

            $statusText = $this->option('publish') ? 'publicado' : 'salvo como rascunho';

            $this->newLine();
            $this->info("✅ Post {$statusText} com sucesso!");
            $this->line("   📌 Título: {$post->title}");
            $this->line("   🔗 Slug: {$post->slug}");
            if ($category) {
                $this->line("   📁 Categoria: {$category->name}");
            }
            if ($author) {
                $this->line("   ✍️  Autor: {$author->name}");
            }

            // Log do sucesso
            Log::info('Post de blog gerado automaticamente', [
                'post_id' => $post->id,
                'topic' => $topic,
                'status' => $postData['status'],
            ]);

            return Command::SUCCESS;

        } catch (Exception $e) {
            $this->error("❌ Erro ao gerar post: {$e->getMessage()}");

            Log::error('Erro ao gerar post de blog diário', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return Command::FAILURE;
        }
    }

    private function getCategory(): ?BlogCategory
    {
        if ($categoryId = $this->option('category')) {
            return BlogCategory::find($categoryId);
        }

        // Tenta encontrar ou criar categoria padrão para posts automáticos
        return BlogCategory::firstOrCreate(
            ['slug' => 'gestao-empresarial'],
            [
                'name' => 'Gestão Empresarial',
                'description' => 'Conteúdos sobre gestão, vendas e crescimento empresarial',
            ]
        );
    }

    private function getAuthor(): ?User
    {
        if ($authorId = $this->option('author')) {
            return User::find($authorId);
        }

        // Busca o primeiro admin ou o primeiro usuário
        return User::where('is_admin', true)->first()
            ?? User::orderBy('id')->first();
    }

    private function selectTopic(): ?string
    {
        // Se foi especificado um tópico manualmente
        if ($topic = $this->option('topic')) {
            return $topic;
        }

        // Busca posts recentes (últimos 30 dias) para evitar tópicos repetidos
        $recentPosts = BlogPost::where('created_at', '>=', now()->subDays(30))
            ->pluck('title')
            ->toArray();

        // Filtra tópicos que não foram usados recentemente
        $availableTopics = array_filter($this->topics, function ($topic) use ($recentPosts) {
            foreach ($recentPosts as $recentTitle) {
                // Verifica se o tópico é muito similar a algum título recente
                similar_text(mb_strtolower($topic), mb_strtolower($recentTitle), $similarity);
                if ($similarity > 70) {
                    return false;
                }
            }

            return true;
        });

        // Se não houver tópicos disponíveis, usa todos
        if (empty($availableTopics)) {
            $availableTopics = $this->topics;
        }

        // Seleciona um tópico aleatório dos disponíveis
        return $availableTopics[array_rand($availableTopics)] ?? null;
    }
}
