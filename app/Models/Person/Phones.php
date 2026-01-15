<?php

declare(strict_types=1);

namespace App\Models\Person;

use App\Filament\Components\PhoneComponent;
use Filament\Forms\Components\Repeater;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

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
                PhoneComponent::make('number')
                    ->label('Telefone')
                    ->placeholder('(00) 00000-0000')
                    ->required(),
            ])
            ->defaultItems(1)
            ->columnSpan(1)
            ->addActionLabel('Adicionar telefone')
            ->reorderable()
            ->collapsible();
    }
}
