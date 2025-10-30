<?php

declare(strict_types=1);

namespace App\Models\Person;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Leandrocfe\FilamentPtbrFormFields\PtbrPhone;

/**
 * @property int $id
 * @property int $supplier_id
 * @property string $name
 * @property string|null $position
 * @property string|null $phone
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read Person $supplier
 */
final class SupplierRepresentative extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'supplier_id',
        'name',
        'position',
        'phone',
        'email',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'supplier_id' => 'integer',
    ];

    public static function getForm(): Repeater
    {
        return Repeater::make('supplierRepresentatives')
            ->relationship()
            ->hiddenLabel()
            ->table([
                TableColumn::make('Nome'),
                TableColumn::make('Cargo'),
                TableColumn::make('Telefone'),
                TableColumn::make('E-mail'),
            ])
            ->compact(true)
            ->schema([
                TextInput::make('name')
                    ->label('Nome')
                    ->placeholder('Nome do representante')
                    ->required()
                    ->maxLength(50)
                    ->columnSpan(1),
                TextInput::make('position')
                    ->label('Cargo')
                    ->placeholder('Ex: Gerente Comercial')
                    ->maxLength(50)
                    ->columnSpan(1),
                PtbrPhone::make('phone')
                    ->label('Telefone')
                    ->placeholder('(00) 00000-0000')
                    ->tel()
                    ->columnSpan(1),
                TextInput::make('email')
                    ->label('E-mail')
                    ->placeholder('email@exemplo.com.br')
                    ->email()
                    ->maxLength(255)
                    ->columnSpan(1),
            ])
            ->columns(4)
            ->defaultItems(0)
            ->columnSpan(1)
            ->addActionLabel('Adicionar representante')
            ->reorderable()
            ->collapsible();
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'supplier_id');
    }
}
