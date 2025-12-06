<?php

namespace App\Filament\Exports;

use App\Models\Activity;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class ActivityExporter extends Exporter
{
    protected static ?string $model = Activity::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('tenant.name'),
            ExportColumn::make('person.name'),
            ExportColumn::make('assigned_to'),
            ExportColumn::make('title'),
            ExportColumn::make('description'),
            ExportColumn::make('status'),
            ExportColumn::make('priority'),
            ExportColumn::make('type'),
            ExportColumn::make('due_date'),
            ExportColumn::make('completed_at'),
            ExportColumn::make('notes'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
            ExportColumn::make('deleted_at'),
            ExportColumn::make('start_date'),
            ExportColumn::make('completion_date'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your activity export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
