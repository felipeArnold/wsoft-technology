<?php

declare(strict_types=1);

namespace App\Models\Person;

use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $photoable_type
 * @property int $photoable_id
 * @property string $path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @mixin \Eloquent
 */
final class Photos extends Model
{
    use HasFactory;

    public static function getForm(): array
    {
        return [
            FileUpload::make('path')
                ->label('Fotos')
                ->preserveFilenames()
                ->image()
                ->imageEditor()
                ->panelLayout('grid')
                ->reorderable()
                ->maxSize(512)
                ->appendFiles(),
        ];
    }
}
