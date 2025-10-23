<?php

declare(strict_types=1);

namespace App\Models\Person;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $emailable_type
 * @property int $emailable_id
 * @property string $address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
final class Emails extends Model
{
    use HasFactory;

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
        return Repeater::make('emails')
            ->relationship('emails')
            ->hiddenLabel()
            ->compact(true)
            ->table([
                TableColumn::make('E-mail'),
            ])
            ->schema([
                TextInput::make('address')
                    ->label('E-mail')
                    ->nullable()
                    ->email(),
            ])
            ->default([])
            ->columnSpan(1)
            ->addActionLabel('Adicionar e-mail');
    }
}
