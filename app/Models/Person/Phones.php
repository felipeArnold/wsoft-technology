<?php

declare(strict_types=1);

namespace App\Models\Person;

use Icetalker\FilamentTableRepeater\Forms\Components\TableRepeater;
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

    public static function getForm(): array
    {
        return [
            TableRepeater::make('phones')
                ->relationship('phones')
                ->label('Telefones')
                ->schema([
                    PtbrPhone::make('number')
                        ->label('Telefone')
                        ->tel()
                        ->default(null),
                ])
                ->default([])
                ->columnSpan(1),
        ];
    }
}
