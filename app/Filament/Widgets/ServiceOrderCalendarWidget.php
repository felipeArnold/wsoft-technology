<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\ServiceOrder;
use Filament\Facades\Filament;
use Guava\Calendar\Enums\CalendarViewType;
use Guava\Calendar\Filament\CalendarWidget;
use Guava\Calendar\ValueObjects\CalendarView;
use Guava\Calendar\ValueObjects\FetchInfo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;

final class ServiceOrderCalendarWidget extends CalendarWidget
{
    protected CalendarViewType $calendarView = CalendarViewType::ListWeek;

    protected int|string|array $columnSpan = 2;

    protected string|HtmlString|null|bool $heading = 'Agendamento de Ordens de Serviço';

    protected bool $dateClickEnabled = true;

    protected ?string $pollingInterval = null;

    protected function getEvents(FetchInfo $info): Collection|array|Builder
    {
        return ServiceOrder::query()
            ->where('tenant_id', Filament::getTenant()->id)
            ->whereNotNull('scheduled_start_at')
            ->whereBetween('scheduled_start_at', [$info->start, $info->end]);
    }

    protected function getEventClickContextMenuActions(): array
    {
        return [
            $this->viewAction(),
            $this->editAction(),
            $this->deleteAction(),
        ];
    }

    protected function getViews(): array
    {
        return [
            CalendarView::make(CalendarViewType::TimeGridDay)
                ->title('Dia')
                ->icon('heroicon-o-calendar-days'),
            CalendarView::make(CalendarViewType::TimeGridWeek)
                ->title('Semana')
                ->icon('heroicon-o-calendar'),
            CalendarView::make(CalendarViewType::DayGridMonth)
                ->title('Mês')
                ->icon('heroicon-o-calendar-date-range'),
            CalendarView::make(CalendarViewType::ListWeek)
                ->title('Lista Semana')
                ->icon('heroicon-o-list-bullet'),
            CalendarView::make(CalendarViewType::ListMonth)
                ->title('Lista Mês')
                ->icon('heroicon-o-queue-list'),
        ];
    }
}
