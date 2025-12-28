<?php

declare(strict_types=1);

namespace App\Enum\Template;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum TemplateContext: string implements HasColor, HasLabel
{
    case ServiceOrder = 'ServiceOrder';
    case AccountsPayable = 'AccountsPayable';
    case AccountsReceivable = 'AccountsReceivable';
    case Overdue = 'Overdue';

    public function getLabel(): string
    {
        return match ($this) {
            self::ServiceOrder => 'Ordem de Serviço',
            self::AccountsPayable => 'Contas a Pagar',
            self::AccountsReceivable => 'Contas a Receber',
            self::Overdue => 'Inadimplência',
        };
    }


    public function getColor(): string
    {
        return match ($this) {
            self::ServiceOrder => 'info',
            self::AccountsPayable => 'warning',
            self::AccountsReceivable => 'success',
            self::Overdue => 'danger',
        };
    }
}
