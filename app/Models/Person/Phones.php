<?php

declare(strict_types=1);

namespace App\Models\Person;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Leandrocfe\FilamentPtbrFormFields\PtbrPhone;

/**
 * @property int $id
 * @property string $phonable_type
 * @property int $phonable_id
 * @property string $number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
final class Phones extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number',
        'morphs',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public static function getForm(): Repeater
    {
        return Repeater::make('phones')
            ->relationship()
            ->hiddenLabel()
            ->table([
                TableColumn::make('Número'),
            ])
            ->compact(true)
            ->schema([
                PtbrPhone::make('number')
                    ->label('Telefone')
                    ->tel()
                    ->default(null),
            ])
            ->defaultItems(1)
            ->columnSpan(1)
            ->addActionLabel('Adicionar telefone');
    }
}
