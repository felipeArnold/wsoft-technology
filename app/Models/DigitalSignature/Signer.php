<?php

declare(strict_types=1);

namespace App\Models\DigitalSignature;

use App\Enum\DigitalSignature\SignatarioType;
use App\Models\Tenant;
use Database\Factories\DigitalSignature\SignatarioFactory;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Signer extends Model
{
    /** @use HasFactory<SignatarioFactory> */
    use HasFactory;

    protected $fillable = [
        'envelope_id',
        'name',
        'document_number',
        'email',
        'phone',
        'birth_date',
        'signer_type',
        'signature_with_photo',
        'document_front',
        'document_back',
        'signature',
        'rubric',
        'status',
        'signed_at',
        'rejection_reason',
        'zapsign_token',
        'zapsign_sign_url',
    ];

    public static function getForm(): array
    {
        return [
            TextInput::make('name')
                ->label('Nome Completo')
                ->required()
                ->maxLength(255)
                ->columnSpan(2),
            TextInput::make('document_number')
                ->label('CPF/CNPJ')
                ->required()
                ->maxLength(20)
                ->columnSpan(1),
            TextInput::make('email')
                ->label('E-mail')
                ->email()
                ->required()
                ->maxLength(255)
                ->columnSpan(1),
            TextInput::make('phone')
                ->label('Telefone')
                ->tel()
                ->maxLength(20)
                ->columnSpan(1),
            DatePicker::make('birth_date')
                ->label('Data de Nascimento')
                ->native(false)
                ->columnSpan(1),
            Select::make('signer_type')
                ->label('Tipo de Signatário')
                ->options(SignatarioType::options())
                ->required()
                ->native(false)
                ->columnSpan(1),
            Checkbox::make('signature_with_photo')
                ->label('Assinatura com Foto')
                ->columnSpan(1),
            FileUpload::make('document_front')
                ->label('Documento - Frente')
                ->acceptedFileTypes(['image/*', 'application/pdf'])
                ->maxSize(1024 * 5) // 5MB
                ->columnSpan(1),
            FileUpload::make('document_back')
                ->label('Documento - Verso')
                ->acceptedFileTypes(['image/*', 'application/pdf'])
                ->maxSize(1024 * 5) // 5MB
                ->columnSpan(1),
            FileUpload::make('signature')
                ->label('Assinatura Digital')
                ->acceptedFileTypes(['image/*'])
                ->maxSize(1024 * 2) // 2MB
                ->columnSpan(1),
            FileUpload::make('rubric')
                ->label('Rubrica')
                ->acceptedFileTypes(['image/*'])
                ->maxSize(1024 * 2) // 2MB
                ->columnSpan(1),
            Select::make('status')
                ->label('Status')
                ->options([
                    'pending' => 'Pendente',
                    'signed' => 'Assinado',
                    'rejected' => 'Rejeitado',
                    'expired' => 'Expirado',
                ])
                ->default('pending')
                ->required()
                ->native(false)
                ->columnSpan(1),
            DatePicker::make('signed_at')
                ->label('Data da Assinatura')
                ->native(false)
                ->columnSpan(1),
        ];
    }

    public function envelope(): BelongsTo
    {
        return $this->belongsTo(Envelope::class);
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'signed_at' => 'datetime',
            'signature_with_photo' => 'boolean',
        ];
    }
}
