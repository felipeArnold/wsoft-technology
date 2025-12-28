<?php

declare(strict_types=1);

namespace App\Filament\Clusters\Settings\EmailTemplates\Pages;

use App\Enum\Template\TemplateContext;
use App\Filament\Clusters\Settings\EmailTemplates\EmailTemplateResource;
use App\Models\EmailTemplate;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

final class ListEmailTemplates extends ListRecords
{
    public ?string $activeTab = 'all';

    protected static string $resource = EmailTemplateResource::class;

    public function getTabs(): array
    {
        $templates = EmailTemplate::query()
            ->select('context')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('context')
            ->pluck('count', 'context')
            ->toArray();

        $tabs = [
            'all' => Tab::make()
                ->label('Todos')
                ->badge(fn () => array_sum($templates))
                ->badgeColor('primary'),
        ];

        foreach (TemplateContext::cases() as $context) {
            $tabKey = mb_strtolower(str_replace('_', '', preg_replace('/([A-Z])/', '_$1', lcfirst($context->name))));

            $tabs[$tabKey] = Tab::make()
                ->label($context->getLabel())
                ->badge(fn () => collect($templates)->get($context->value, 0))
                ->badgeColor($context->getColor())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('context', $context->value));
        }

        return $tabs;
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Novo Template')
                ->icon('heroicon-o-plus'),
        ];
    }
}
