<?php

declare(strict_types=1);

namespace App\Models\Person;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Leandrocfe\FilamentPtbrFormFields\PtbrPhone;

/**
 * @property int $id
 * @property string $phonable_type
 * @property int $phonable_id
 * @property string $number
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
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
            ->schema([
                PtbrPhone::make('number')
                    ->label('Telefone')
                    ->placeholder('(00) 00000-0000')
                    ->tel()
                    ->required()
                    ->default(null),
            ])
            ->defaultItems(1)
            ->columnSpan(1)
            ->addActionLabel('Adicionar telefone')
            ->reorderable()
            ->collapsible();
    }
}
