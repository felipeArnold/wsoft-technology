<?php

declare(strict_types=1);

namespace App\Filament\Imports;

use App\Models\Activity;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

final class ActivityImporter extends Importer
{
    protected static ?string $model = Activity::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('person')
                ->relationship(),
            ImportColumn::make('assigned_to')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('title')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('description'),
            ImportColumn::make('status')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('priority')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('type')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('due_date')
                ->rules(['date']),
            ImportColumn::make('completed_at')
                ->rules(['datetime']),
            ImportColumn::make('notes'),
            ImportColumn::make('start_date')
                ->rules(['datetime']),
            ImportColumn::make('completion_date')
                ->rules(['datetime']),
        ];
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your activity import has completed and '.Number::format($import->successful_rows).' '.str('row')->plural($import->successful_rows).' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '.Number::format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to import.';
        }

        return $body;
    }

    public function resolveRecord(): Activity
    {
        return new Activity();
    }
}
