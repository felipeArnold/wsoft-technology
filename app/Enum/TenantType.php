<?php

declare(strict_types=1);

namespace App\Enum;

enum TenantType: string
{
    // Automotivo
    case MECHANIC = 'mechanic';
    case AUTO_REPAIR = 'auto_repair';
    case CAR_DEALERSHIP = 'car_dealership';
    case AUTO_PARTS = 'auto_parts';
    case CAR_WASH = 'car_wash';
    case TIRE_SHOP = 'tire_shop';

    // Beleza e Estética
    case BARBERSHOP = 'barbershop';
    case BEAUTY_SALON = 'beauty_salon';
    case NAIL_SALON = 'nail_salon';
    case SPA = 'spa';
    case AESTHETICS_CLINIC = 'aesthetics_clinic';

    // Saúde
    case CLINIC = 'clinic';
    case DENTAL_CLINIC = 'dental_clinic';
    case VETERINARY = 'veterinary';
    case PHARMACY = 'pharmacy';
    case LABORATORY = 'laboratory';
    case PHYSICAL_THERAPY = 'physical_therapy';

    // Alimentação
    case RESTAURANT = 'restaurant';
    case BAKERY = 'bakery';
    case CAFE = 'cafe';
    case BAR = 'bar';
    case PIZZERIA = 'pizzeria';
    case FOOD_DELIVERY = 'food_delivery';
    case CATERING = 'catering';

    // Varejo
    case RETAIL_STORE = 'retail_store';
    case SUPERMARKET = 'supermarket';
    case CONVENIENCE_STORE = 'convenience_store';
    case CLOTHING_STORE = 'clothing_store';
    case SHOE_STORE = 'shoe_store';
    case ELECTRONICS_STORE = 'electronics_store';
    case BOOKSTORE = 'bookstore';
    case PET_SHOP = 'pet_shop';

    // Serviços Profissionais
    case ACCOUNTING = 'accounting';
    case LAW_FIRM = 'law_firm';
    case CONSULTING = 'consulting';
    case MANAGEMENT = 'management';
    case ARCHITECTURE = 'architecture';
    case ENGINEERING = 'engineering';
    case REAL_ESTATE = 'real_estate';
    case INSURANCE = 'insurance';

    // Tecnologia
    case SOFTWARE_DEVELOPMENT = 'software_development';
    case IT_SERVICES = 'it_services';
    case WEB_DESIGN = 'web_design';
    case DIGITAL_MARKETING = 'digital_marketing';

    // Educação
    case SCHOOL = 'school';
    case LANGUAGE_SCHOOL = 'language_school';
    case TRAINING_CENTER = 'training_center';
    case DAYCARE = 'daycare';

    // Construção e Manutenção
    case CONSTRUCTION = 'construction';
    case PLUMBING = 'plumbing';
    case ELECTRICAL = 'electrical';
    case PAINTING = 'painting';
    case CARPENTRY = 'carpentry';
    case CLEANING_SERVICES = 'cleaning_services';

    // Esporte e Lazer
    case GYM = 'gym';
    case SPORTS_CENTER = 'sports_center';
    case TRAVEL_AGENCY = 'travel_agency';
    case EVENT_PLANNING = 'event_planning';

    // Outros
    case SECURITY = 'security';
    case LOGISTICS = 'logistics';
    case TRANSPORTATION = 'transportation';
    case AGRICULTURE = 'agriculture';
    case INDUSTRY = 'industry';
    case OTHER = 'other';

    public static function toSelectArray(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $case) => [$case->value => $case->getLabel()])
            ->sortBy(fn ($label) => $label)
            ->toArray();
    }

    public function getLabel(): string
    {
        return match ($this) {
            // Automotivo
            self::MECHANIC => 'Mecânica',
            self::AUTO_REPAIR => 'Oficina Automotiva',
            self::CAR_DEALERSHIP => 'Concessionária',
            self::AUTO_PARTS => 'Auto Peças',
            self::CAR_WASH => 'Lava Jato',
            self::TIRE_SHOP => 'Borracharia',

            // Beleza e Estética
            self::BARBERSHOP => 'Barbearia',
            self::BEAUTY_SALON => 'Salão de Beleza',
            self::NAIL_SALON => 'Manicure/Pedicure',
            self::SPA => 'SPA',
            self::AESTHETICS_CLINIC => 'Clínica de Estética',

            // Saúde
            self::CLINIC => 'Clínica Médica',
            self::DENTAL_CLINIC => 'Clínica Odontológica',
            self::VETERINARY => 'Veterinária',
            self::PHARMACY => 'Farmácia',
            self::LABORATORY => 'Laboratório',
            self::PHYSICAL_THERAPY => 'Fisioterapia',

            // Alimentação
            self::RESTAURANT => 'Restaurante',
            self::BAKERY => 'Padaria',
            self::CAFE => 'Cafeteria',
            self::BAR => 'Bar',
            self::PIZZERIA => 'Pizzaria',
            self::FOOD_DELIVERY => 'Delivery de Alimentos',
            self::CATERING => 'Buffet/Catering',

            // Varejo
            self::RETAIL_STORE => 'Loja de Varejo',
            self::SUPERMARKET => 'Supermercado',
            self::CONVENIENCE_STORE => 'Loja de Conveniência',
            self::CLOTHING_STORE => 'Loja de Roupas',
            self::SHOE_STORE => 'Calçados',
            self::ELECTRONICS_STORE => 'Loja de Eletrônicos',
            self::BOOKSTORE => 'Livraria',
            self::PET_SHOP => 'Pet Shop',

            // Serviços Profissionais
            self::ACCOUNTING => 'Contabilidade',
            self::LAW_FIRM => 'Escritório de Advocacia',
            self::CONSULTING => 'Consultoria',
            self::MANAGEMENT => 'Gestão Empresarial',
            self::ARCHITECTURE => 'Arquitetura',
            self::ENGINEERING => 'Engenharia',
            self::REAL_ESTATE => 'Imobiliária',
            self::INSURANCE => 'Seguros',

            // Tecnologia
            self::SOFTWARE_DEVELOPMENT => 'Desenvolvimento de Software',
            self::IT_SERVICES => 'Serviços de TI',
            self::WEB_DESIGN => 'Web Design',
            self::DIGITAL_MARKETING => 'Marketing Digital',

            // Educação
            self::SCHOOL => 'Escola',
            self::LANGUAGE_SCHOOL => 'Escola de Idiomas',
            self::TRAINING_CENTER => 'Centro de Treinamento',
            self::DAYCARE => 'Creche',

            // Construção e Manutenção
            self::CONSTRUCTION => 'Construção Civil',
            self::PLUMBING => 'Encanamento',
            self::ELECTRICAL => 'Elétrica',
            self::PAINTING => 'Pintura',
            self::CARPENTRY => 'Marcenaria',
            self::CLEANING_SERVICES => 'Serviços de Limpeza',

            // Esporte e Lazer
            self::GYM => 'Academia',
            self::SPORTS_CENTER => 'Centro Esportivo',
            self::TRAVEL_AGENCY => 'Agência de Viagens',
            self::EVENT_PLANNING => 'Organização de Eventos',

            // Outros
            self::SECURITY => 'Segurança',
            self::LOGISTICS => 'Logística',
            self::TRANSPORTATION => 'Transporte',
            self::AGRICULTURE => 'Agricultura',
            self::INDUSTRY => 'Indústria',
            self::OTHER => 'Outros',
        };
    }

    public function isAutomotive(): bool
    {
        return in_array($this, [
            self::MECHANIC,
            self::AUTO_REPAIR,
            self::CAR_DEALERSHIP,
            self::AUTO_PARTS,
            self::CAR_WASH,
            self::TIRE_SHOP,
        ], strict: true);
    }

    public function getDescription(): string
    {
        return match ($this) {
            // Automotivo
            self::MECHANIC => 'Serviços de mecânica automotiva',
            self::AUTO_REPAIR => 'Oficina de reparos e manutenção de veículos',
            self::CAR_DEALERSHIP => 'Venda de veículos novos e seminovos',
            self::AUTO_PARTS => 'Comércio de peças automotivas',
            self::CAR_WASH => 'Lavagem e higienização de veículos',
            self::TIRE_SHOP => 'Venda e troca de pneus',

            // Beleza e Estética
            self::BARBERSHOP => 'Serviços de corte e cuidados masculinos',
            self::BEAUTY_SALON => 'Serviços de beleza e cuidados capilares',
            self::NAIL_SALON => 'Serviços de manicure e pedicure',
            self::SPA => 'Centro de estética e bem-estar',
            self::AESTHETICS_CLINIC => 'Tratamentos estéticos e corporais',

            // Saúde
            self::CLINIC => 'Atendimento médico e consultas',
            self::DENTAL_CLINIC => 'Serviços odontológicos',
            self::VETERINARY => 'Cuidados com animais',
            self::PHARMACY => 'Venda de medicamentos e produtos de saúde',
            self::LABORATORY => 'Exames laboratoriais',
            self::PHYSICAL_THERAPY => 'Tratamentos fisioterapêuticos',

            // Alimentação
            self::RESTAURANT => 'Serviço de alimentação completo',
            self::BAKERY => 'Panificação e confeitaria',
            self::CAFE => 'Cafés e lanches',
            self::BAR => 'Bebidas e petiscos',
            self::PIZZERIA => 'Pizzas e massas',
            self::FOOD_DELIVERY => 'Entrega de alimentos',
            self::CATERING => 'Serviços de buffet para eventos',

            // Varejo
            self::RETAIL_STORE => 'Comércio varejista geral',
            self::SUPERMARKET => 'Supermercado e mercearia',
            self::CONVENIENCE_STORE => 'Loja de conveniência',
            self::CLOTHING_STORE => 'Vestuário e acessórios',
            self::SHOE_STORE => 'Comércio de calçados',
            self::ELECTRONICS_STORE => 'Eletrônicos e tecnologia',
            self::BOOKSTORE => 'Livros e papelaria',
            self::PET_SHOP => 'Produtos para animais de estimação',

            // Serviços Profissionais
            self::ACCOUNTING => 'Serviços contábeis e fiscais',
            self::LAW_FIRM => 'Serviços jurídicos e advocacia',
            self::CONSULTING => 'Consultoria empresarial',
            self::MANAGEMENT => 'Gestão e administração de negócios',
            self::ARCHITECTURE => 'Projetos arquitetônicos',
            self::ENGINEERING => 'Serviços de engenharia',
            self::REAL_ESTATE => 'Corretagem de imóveis',
            self::INSURANCE => 'Seguros e corretagem',

            // Tecnologia
            self::SOFTWARE_DEVELOPMENT => 'Desenvolvimento de sistemas e aplicativos',
            self::IT_SERVICES => 'Suporte e infraestrutura de TI',
            self::WEB_DESIGN => 'Design e desenvolvimento web',
            self::DIGITAL_MARKETING => 'Marketing e publicidade digital',

            // Educação
            self::SCHOOL => 'Ensino fundamental e médio',
            self::LANGUAGE_SCHOOL => 'Cursos de idiomas',
            self::TRAINING_CENTER => 'Cursos profissionalizantes',
            self::DAYCARE => 'Cuidados infantis',

            // Construção e Manutenção
            self::CONSTRUCTION => 'Obras e construção',
            self::PLUMBING => 'Instalações hidráulicas',
            self::ELECTRICAL => 'Instalações elétricas',
            self::PAINTING => 'Serviços de pintura',
            self::CARPENTRY => 'Móveis e marcenaria',
            self::CLEANING_SERVICES => 'Limpeza residencial e comercial',

            // Esporte e Lazer
            self::GYM => 'Academia de ginástica e musculação',
            self::SPORTS_CENTER => 'Atividades esportivas diversas',
            self::TRAVEL_AGENCY => 'Planejamento de viagens e turismo',
            self::EVENT_PLANNING => 'Organização e produção de eventos',

            // Outros
            self::SECURITY => 'Serviços de segurança',
            self::LOGISTICS => 'Logística e distribuição',
            self::TRANSPORTATION => 'Transporte de passageiros ou cargas',
            self::AGRICULTURE => 'Produção agrícola',
            self::INDUSTRY => 'Fabricação e manufatura',
            self::OTHER => 'Outros tipos de negócios',
        };
    }
}
