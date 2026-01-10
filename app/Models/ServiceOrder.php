<?php

declare(strict_types=1);

namespace App\Models;

use App\DTOs\VehicleData;
use App\Enum\ServiceOrderPriority;
use App\Enum\ServiceOrderStatus;
use App\Filament\Clusters\Settings\Services\ServiceResource;
use App\Filament\Components\PtbrMoney;
use App\Filament\Resources\Creates\Products\ProductResource;
use App\Helpers\FormatterHelper;
use App\Models\Accounts\Accounts;
use App\Models\Concerns\Categorizable;
use App\Models\Person\Person;
use App\Observers\ServiceOrderObserver;
use App\Repositories\VehicleRepository;
use Carbon\Carbon;
use Database\Factories\ServiceOrderFactory;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Guava\Calendar\Contracts\Eventable;
use Guava\Calendar\ValueObjects\CalendarEvent;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[ObservedBy(ServiceOrderObserver::class)]
final class ServiceOrder extends Model implements Eventable
{
    /** @use HasFactory<ServiceOrderFactory> */
    use Categorizable;

    use HasFactory;

    protected $casts = [
        'status' => ServiceOrderStatus::class,
        'priority' => ServiceOrderPriority::class,
        'opening_date' => 'date',
        'expected_completion_date' => 'date',
        'completion_date' => 'date',
        'completed_at' => 'datetime',
        'scheduled_start_at' => 'datetime',
        'scheduled_end_at' => 'datetime',
        'appointment_confirmed' => 'boolean',
        'appointment_confirmation_sent_at' => 'datetime',
        'appointment_reminder_sent_at' => 'datetime',
        'budget_valid_until' => 'date',
        'budget_approved_at' => 'datetime',
        'total_value' => 'float',
        'labor_value' => 'float',
        'parts_value' => 'float',
        'attachments' => 'array',
    ];

    public static function getForm(): array
    {
        return [
            Tabs::make('service_order_tabs')
                ->columnSpanFull()
                ->tabs([
                    Tab::make('basic_info')
                        ->label('Informações Básicas')
                        ->icon('heroicon-o-clipboard-document-list')
                        ->schema([
                            Section::make('Informações da Ordem de Serviço')
                                ->icon('heroicon-o-clipboard-document-list')
                                ->schema([
                                    TextInput::make('number')
                                        ->label('Número')
                                        ->placeholder(fn (string $context) => $context === 'create' ? 'Será gerado automaticamente' : '')
                                        ->disabled()
                                        ->maxLength(50)
                                        ->columnSpan(1),
                                    Select::make('status')
                                        ->label('Status')
                                        ->options(ServiceOrderStatus::toSelectArray())
                                        ->live()
                                        ->default(ServiceOrderStatus::DRAFT->value)
                                        ->required()
                                        ->native(false)
                                        ->columnSpan(1),
                                    Select::make('priority')
                                        ->label('Prioridade')
                                        ->options(ServiceOrderPriority::toSelectArray())
                                        ->default(ServiceOrderPriority::MEDIUM->value)
                                        ->required()
                                        ->native(false)
                                        ->columnSpan(1),
                                    DatePicker::make('opening_date')
                                        ->label('Data de Abertura')
                                        ->required()
                                        ->native()
                                        ->default(now())
                                        ->native(false)
                                        ->columnSpan(1),
                                    DatePicker::make('expected_completion_date')
                                        ->label('Data Prevista de Conclusão')
                                        ->native(false)
                                        ->columnSpan(1),
                                    DatePicker::make('completion_date')
                                        ->label('Data de Conclusão')
                                        ->native(false)
                                        ->columnSpan(1),
                                ])
                                ->columns(3)
                                ->columnSpanFull(),

                            Section::make('Cliente e Responsável')
                                ->icon('heroicon-o-users')
                                ->schema([
                                    Select::make('person_id')
                                        ->label('Cliente')
                                        ->relationship('person', 'name')
                                        ->searchable()
                                        ->preload()
                                        ->required()
                                        ->reactive()
                                        ->createOptionForm(fn (Schema $schema) => $schema->components([
                                            ...Person::getForm(),
                                        ]))
                                        ->afterStateUpdated(fn ($set) => $set('vehicle_id', null))
                                        ->columnSpan(1),
                                    Select::make('vehicle_id')
                                        ->label('Veículo')
                                        ->relationship(
                                            'vehicle',
                                            'plate',
                                            fn ($query, $get) => $query->when(
                                                $get('person_id'),
                                                fn ($query, $personId) => $query->where('person_id', $personId)
                                            )
                                        )
                                        ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->plate} - {$record->brand} {$record->model}")
                                        ->searchable()
                                        ->preload()
                                        ->disabled(fn ($get) => ! $get('person_id'))
                                        ->createOptionForm([
                                            Section::make('Informações do Veículo')
                                                ->description('Preencha os dados do veículo')
                                                ->icon('heroicon-o-truck')
                                                ->schema(Vehicle::getFormFields(includePersonField: false))
                                                ->columns(3)
                                                ->columnSpanFull(),
                                        ])
                                        ->createOptionUsing(function (array $data, $get): int {
                                            $repository = app(VehicleRepository::class);

                                            $vehicleData = VehicleData::fromArray(
                                                data: $data,
                                                tenantId: Filament::getTenant()->id,
                                                personId: $get('person_id')
                                            );

                                            $vehicle = $repository->create($vehicleData);

                                            return $vehicle->id;
                                        })
                                        ->columnSpan(1),
                                    Select::make('user_id')
                                        ->label('Responsável')
                                        ->default(fn () => Filament::auth()->user()?->id)
                                        ->relationship('user', 'name')
                                        ->searchable()
                                        ->preload()
                                        ->required()
                                        ->columnSpan(1),
                                    Select::make('assigned_user_id')
                                        ->label('Responsável Técnico')
                                        ->relationship('userAssigned', 'name')
                                        ->helperText('Usuário responsável pela execução técnica da ordem de serviço')
                                        ->searchable()
                                        ->preload()
                                        ->columnSpan(1),
                                ])
                                ->columns(2)
                                ->columnSpanFull(),

                            Section::make('Agendamento')
                                ->icon('heroicon-o-calendar-days')
                                ->description('Configure o horário de atendimento do cliente')
                                ->schema([
                                    DateTimePicker::make('scheduled_start_at')
                                        ->label('Data e Hora de Início')
                                        ->native(true)
                                        ->seconds(false)
                                        ->timezone('America/Sao_Paulo')
                                        ->displayFormat('d/m/Y H:i')
                                        ->helperText('Defina o horário exato para o cliente trazer o veículo')
                                        ->reactive()
                                        ->afterStateUpdated(function ($state, $set, $get) {
                                            // Auto-set end time to 2 hours after start if not set
                                            if ($state && ! $get('scheduled_end_at')) {
                                                $endTime = Carbon::parse($state)->addHours(2);
                                                $set('scheduled_end_at', $endTime);
                                            }
                                        })
                                        ->columnSpan(1),

                                    DateTimePicker::make('scheduled_end_at')
                                        ->label('Data e Hora de Término (Previsão)')
                                        ->native(true)
                                        ->seconds(false)
                                        ->timezone('America/Sao_Paulo')
                                        ->displayFormat('d/m/Y H:i')
                                        ->helperText('Previsão de quando o serviço será concluído')
                                        ->disabled(fn ($get) => ! $get('scheduled_start_at'))
                                        ->minDate(fn ($get) => $get('scheduled_start_at'))
                                        ->columnSpan(1),

                                    Placeholder::make('appointment_duration')
                                        ->label('Duração Estimada')
                                        ->content(function ($get) {
                                            $start = $get('scheduled_start_at');
                                            $end = $get('scheduled_end_at');

                                            if (! $start || ! $end) {
                                                return 'Defina início e término';
                                            }

                                            $duration = Carbon::parse($start)->diffInMinutes(Carbon::parse($end));
                                            $hours = floor($duration / 60);
                                            $minutes = $duration % 60;

                                            return $hours > 0
                                                ? "{$hours}h {$minutes}min"
                                                : "{$minutes} minutos";
                                        })
                                        ->columnSpan(1),

                                    Placeholder::make('appointment_status')
                                        ->label('Status do Agendamento')
                                        ->content(function ($record) {
                                            if (! $record || ! $record->hasScheduledAppointment()) {
                                                return 'Não agendado';
                                            }

                                            $status = [];

                                            if ($record->appointment_confirmed) {
                                                $status[] = '✓ Confirmado';
                                            }

                                            if ($record->appointment_confirmation_sent_at) {
                                                $status[] = 'Email enviado em '.$record->appointment_confirmation_sent_at->format('d/m/Y H:i');
                                            }

                                            if ($record->appointment_reminder_sent_at) {
                                                $status[] = 'Lembrete enviado em '.$record->appointment_reminder_sent_at->format('d/m/Y H:i');
                                            }

                                            return $status ? implode(' | ', $status) : 'Pendente confirmação';
                                        })
                                        ->columnSpan(1)
                                        ->hidden(fn ($context) => $context === 'create'),
                                ])
                                ->columns(3)
                                ->columnSpanFull()
                                ->collapsed(fn ($context) => $context === 'create'),

                            Section::make('Validação de Orçamento')
                                ->icon('heroicon-o-document-check')
                                ->description('Gerencie a aprovação e validade do orçamento')
                                ->schema([
                                    DatePicker::make('budget_valid_until')
                                        ->label('Válido Até')
                                        ->native(false)
                                        ->minDate(now())
                                        ->required(fn ($get) => $get('status') === ServiceOrderStatus::BUDGET->value)
                                        ->helperText('Data de validade deste orçamento')
                                        ->columnSpan(1),

                                    Select::make('budget_approval_status')
                                        ->label('Status de Aprovação')
                                        ->options([
                                            'pending' => 'Pendente',
                                            'approved' => 'Aprovado',
                                            'rejected' => 'Rejeitado',
                                        ])
                                        ->default('pending')
                                        ->native(false)
                                        ->required(fn ($get) => $get('status') === ServiceOrderStatus::BUDGET->value)
                                        ->reactive()
                                        ->columnSpan(1),

                                    DateTimePicker::make('budget_approved_at')
                                        ->label('Data de Aprovação/Rejeição')
                                        ->native(false)
                                        ->seconds(false)
                                        ->timezone('America/Sao_Paulo')
                                        ->displayFormat('d/m/Y H:i')
                                        ->disabled(fn ($get) => $get('budget_approval_status') === 'pending')
                                        ->helperText('Preenchido automaticamente ao aprovar/rejeitar')
                                        ->columnSpan(1),

                                    Placeholder::make('budget_status_info')
                                        ->label('Informação')
                                        ->content(function ($get) {
                                            $validUntil = $get('budget_valid_until');
                                            $approvalStatus = $get('budget_approval_status');

                                            if (! $validUntil) {
                                                return 'Defina a data de validade';
                                            }

                                            $validUntilDate = Carbon::parse($validUntil);
                                            $now = now();

                                            if ($approvalStatus === 'approved') {
                                                return '✓ Orçamento Aprovado';
                                            }

                                            if ($approvalStatus === 'rejected') {
                                                return '✗ Orçamento Rejeitado';
                                            }

                                            if ($validUntilDate->isPast()) {
                                                return '⚠ Orçamento Vencido';
                                            }

                                            $daysRemaining = $now->diffInDays($validUntilDate);

                                            return "Válido por {$daysRemaining} dias";
                                        })
                                        ->columnSpan(1),

                                    RichEditor::make('budget_notes')
                                        ->label('Observações sobre o Orçamento')
                                        ->helperText('Informações adicionais, condições especiais, motivo de aprovação/rejeição, etc.')
                                        ->columnSpanFull(),
                                ])
                                ->columns(4)
                                ->columnSpanFull()
                                ->visible(fn ($get) => $get('status') === ServiceOrderStatus::BUDGET->value)
                                ->collapsed(),
                        ]),

                    Tab::make('items')
                        ->label('Serviços e Produtos')
                        ->icon('heroicon-o-shopping-cart')
                        ->schema([
                            self::getServicesSection(),
                            self::getProductsSection(),
                            self::getValuesSection(),
                        ]),

                    Tab::make('attachments_tags')
                        ->label('Informações Adicionais')
                        ->icon('heroicon-o-tag')
                        ->schema([
                            Section::make('Anexos')
                                ->icon('heroicon-o-paper-clip')
                                ->description('Documentos e imagens relacionados')
                                ->schema([
                                    FileUpload::make('attachments')
                                        ->label('Anexos')
                                        ->acceptedFileTypes(['image/*', 'application/pdf'])
                                        ->multiple()
                                        ->maxSize(1024 * 5)
                                        ->columnSpanFull(),
                                ])
                                ->columnSpanFull(),

                            Section::make('Etiquetas')
                                ->icon('heroicon-o-tag')
                                ->description('Classifique esta ordem de serviço com etiquetas')
                                ->schema([
                                    CheckboxList::make('categories')
                                        ->label('Etiquetas')
                                        ->relationship('categories', 'name')
                                        ->options(fn () => Category::query()->pluck('name', 'id'))
                                        ->searchable()
                                        ->bulkToggleable()
                                        ->gridDirection('row')
                                        ->columns(3)
                                        ->columnSpanFull(),
                                ])
                                ->columnSpanFull(),

                            Section::make('Descrição do Serviço')
                                ->icon('heroicon-o-document-text')
                                ->schema([
                                    RichEditor::make('description')
                                        ->label('Descrição')
                                        ->columnSpanFull(),
                                    RichEditor::make('observations')
                                        ->label('Observações')
                                        ->columnSpanFull(),
                                    RichEditor::make('technical_report')
                                        ->label('Relatório Técnico')
                                        ->columnSpanFull(),
                                ])
                                ->columnSpanFull(),
                        ]),
                ]),
        ];
    }

    public static function getTableColumns(): array
    {
        return [
            TextColumn::make('number')
                ->label('Número')
                ->searchable()
                ->sortable(),
            TextColumn::make('person.name')
                ->label('Cliente')
                ->searchable()
                ->sortable(),
            TextColumn::make('vehicle.plate')
                ->label('Veículo')
                ->searchable()
                ->sortable()
                ->formatStateUsing(fn ($record) => $record->vehicle
                    ? "{$record->vehicle->plate} - {$record->vehicle->brand} {$record->vehicle->model}"
                    : 'N/A')
                ->placeholder('N/A')
                ->toggleable(),
            TextColumn::make('status')
                ->label('Status')
                ->badge()
                ->color(fn (ServiceOrderStatus $state): string => $state->getColor())
                ->formatStateUsing(fn (ServiceOrderStatus $state): string => $state->getLabel()),
            TextColumn::make('priority')
                ->label('Prioridade')
                ->badge()
                ->color(fn (ServiceOrderPriority $state): string => $state->getColor())
                ->formatStateUsing(fn (ServiceOrderPriority $state): string => $state->getLabel()),
            TextColumn::make('opening_date')
                ->label('Data de Abertura')
                ->date('d/m/Y')
                ->sortable(),
            TextColumn::make('expected_completion_date')
                ->label('Data Prevista')
                ->date('d/m/Y')
                ->sortable(),
            TextColumn::make('scheduled_start_at')
                ->label('Agendamento')
                ->dateTime('d/m/Y H:i')
                ->sortable()
                ->toggleable()
                ->badge()
                ->color(fn ($record) => $record->isAppointmentToday() ? 'success' : 'gray')
                ->icon(fn ($record) => $record->hasScheduledAppointment() ? 'heroicon-o-calendar-days' : null)
                ->formatStateUsing(fn ($record) => $record->getFormattedAppointmentTime() ?? 'Sem agendamento')
                ->placeholder('Sem agendamento'),
            TextColumn::make('total_value')
                ->label('Valor Total')
                ->money('BRL')
                ->sortable(),
            TextColumn::make('user.name')
                ->label('Responsável')
                ->searchable()
                ->toggleable(),
            TextColumn::make('userAssigned.name')
                ->label('Responsável Técnico')
                ->searchable()
                ->toggleable(),
            TextColumn::make('categories.name')
                ->label('Etiquetas')
                ->badge()
                ->separator(',')
                ->searchable()
                ->toggleable(),
        ];
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function userAssigned(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function serviceOrderServices(): HasMany
    {
        return $this->hasMany(ServiceOrderService::class);
    }

    public function serviceOrderProducts(): HasMany
    {
        return $this->hasMany(ServiceOrderProduct::class);
    }

    public function accounts(): HasMany
    {
        return $this->hasMany(Accounts::class);
    }

    public function commission(): HasOne
    {
        return $this->hasOne(Commission::class);
    }

    public function warranties(): HasMany
    {
        return $this->hasMany(Warranty::class);
    }

    public function hasCommission(): bool
    {
        return $this->commission()->exists();
    }

    /**
     * Check if this service order has an appointment scheduled
     */
    public function hasScheduledAppointment(): bool
    {
        return $this->scheduled_start_at !== null;
    }

    /**
     * Check if appointment is today
     */
    public function isAppointmentToday(): bool
    {
        if (! $this->hasScheduledAppointment()) {
            return false;
        }

        return $this->scheduled_start_at->isToday();
    }

    /**
     * Check if appointment needs reminder (24h before, not sent yet)
     */
    public function needsAppointmentReminder(): bool
    {
        if (! $this->hasScheduledAppointment() || $this->appointment_reminder_sent_at) {
            return false;
        }

        $hoursUntilAppointment = now()->diffInHours($this->scheduled_start_at, false);

        return $hoursUntilAppointment <= 24 && $hoursUntilAppointment > 0;
    }

    /**
     * Get formatted appointment time range
     */
    public function getFormattedAppointmentTime(): ?string
    {
        if (! $this->hasScheduledAppointment()) {
            return null;
        }

        $start = $this->scheduled_start_at->timezone('America/Sao_Paulo')->format('d/m/Y H:i');
        $end = $this->scheduled_end_at?->timezone('America/Sao_Paulo')->format('H:i') ?? '?';

        return "{$start} - {$end}";
    }

    /**
     * Get appointment duration in minutes
     */
    public function getAppointmentDuration(): ?int
    {
        if (! $this->hasScheduledAppointment() || ! $this->scheduled_end_at) {
            return null;
        }

        return $this->scheduled_start_at->diffInMinutes($this->scheduled_end_at);
    }

    public function toCalendarEvent(): CalendarEvent
    {
        $colors = $this->status->getCalendarColor();
        $borderWidth = $this->priority->getBorderWidth();
        $priorityIcon = $this->priority->getIcon();

        return CalendarEvent::make($this)
            ->title($priorityIcon.$this->person->name.' - '.$this->number)
            ->start($this->scheduled_start_at)
            ->end($this->scheduled_end_at ?? $this->scheduled_start_at->addHours(1))
            ->backgroundColor($colors['bg'])
            ->textColor($colors['text'])
            ->styles([
                'border-left' => $borderWidth.' solid '.$colors['border'],
                'border-radius' => '4px',
                'font-weight' => $this->priority === ServiceOrderPriority::URGENT ? 'bold' : 'normal',
            ]);
    }

    private static function getServicesSection(): Section
    {
        return Section::make('Serviços')
            ->description('Adicione os serviços prestados nesta ordem')
            ->afterHeader([
                Action::make('settings')
                    ->label('Configurações de Serviços')
                    ->color('default')
                    ->outlined()
                    ->icon('heroicon-o-cog-6-tooth')
                    ->url(ServiceResource::getUrl('index'))
                    ->openUrlInNewTab(true)
                    ->tooltip('Gerenciar Serviços'),
            ])
            ->icon('heroicon-o-wrench-screwdriver')
            ->schema([
                Repeater::make('serviceOrderServices')
                    ->relationship()
                    ->hiddenLabel()
                    ->compact()
                    ->hiddenLabel()
                    ->default([])
                    ->compact(true)
                    ->table([
                        TableColumn::make('Serviço'),
                        TableColumn::make('Qtd'),
                        TableColumn::make('Preço Unit.'),
                        TableColumn::make('Desconto'),
                        TableColumn::make('Total'),
                    ])
                    ->schema([
                        Select::make('service_id')
                            ->label('Serviço')
                            ->placeholder('Selecione o serviço')
                            ->options(fn () => Service::pluck('name', 'id'))
                            ->native(false)
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, $set, $get): void {
                                if ($state) {
                                    $service = Service::query()->find($state);
                                    if ($service) {
                                        $set('service_name', $service->name);
                                        $set('unit_price', FormatterHelper::money($service->price));
                                        $discount = FormatterHelper::toDecimal($service->discount);
                                        $total = $service->price - $discount;
                                        $set('discount', FormatterHelper::money($discount));
                                        $set('total', FormatterHelper::money($total));
                                        self::recalculateTotals($get, $set);
                                    }
                                }
                            })
                            ->createOptionForm([
                                Section::make('Informações do Serviço')
                                    ->description('Preencha os dados para criar um novo serviço')
                                    ->schema(Service::getFormFields())
                                    ->columns(3)
                                    ->columnSpanFull(),
                            ])
                            ->createOptionUsing(function (array $data): int {
                                $service = Service::query()->create([
                                    'tenant_id' => Filament::getTenant()->id,
                                    'name' => $data['name'],
                                    'price' => FormatterHelper::toDecimal($data['price'] ?? 0),
                                    'discount' => FormatterHelper::toDecimal($data['discount'] ?? 0),
                                    'description' => $data['description'] ?? null,
                                ]);

                                return $service->id;
                            })
                            ->columnSpan(4),
                        Hidden::make('service_name'),
                        TextInput::make('quantity')
                            ->label('Qtd')
                            ->numeric()
                            ->default(1)
                            ->minValue(1)
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, $get, $set): void {
                                $unitPrice = FormatterHelper::toDecimal($get('unit_price'));
                                $discount = FormatterHelper::toDecimal($get('discount'));
                                $total = ($unitPrice * (int) $state) - $discount;
                                $set('total', FormatterHelper::money($total));
                                self::recalculateTotals($get, $set);
                            })
                            ->columnSpan(2),
                        PtbrMoney::make('unit_price')
                            ->label('Preço Unit.')
                            ->default('0,00')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, $get, $set): void {
                                $unitPrice = FormatterHelper::toDecimal($state);
                                $quantity = (int) $get('quantity');
                                $discount = FormatterHelper::toDecimal($get('discount'));
                                $total = ($unitPrice * $quantity) - $discount;
                                $set('total', FormatterHelper::money($total));
                                self::recalculateTotals($get, $set);
                            })
                            ->columnSpan(2),
                        PtbrMoney::make('discount')
                            ->label('Desconto')
                            ->default('0,00')
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, $get, $set): void {
                                $unitPrice = FormatterHelper::toDecimal($get('unit_price'));
                                $quantity = (int) $get('quantity');
                                $discount = FormatterHelper::toDecimal($state);
                                $total = ($unitPrice * $quantity) - $discount;
                                $set('total', FormatterHelper::money($total));
                                self::recalculateTotals($get, $set);
                            })
                            ->columnSpan(2),
                        PtbrMoney::make('total')
                            ->label('Total')
                            ->default('0,00')
                            ->disabled()
                            ->dehydrated()
                            ->columnSpan(2),
                    ])
                    ->columns(12)
                    ->mutateRelationshipDataBeforeCreateUsing(function (array $data): array {
                        $data['tenant_id'] = Filament::getTenant()->id;
                        $data['unit_price'] = FormatterHelper::toDecimal($data['unit_price']);
                        $data['discount'] = FormatterHelper::toDecimal($data['discount']);
                        $data['total'] = FormatterHelper::toDecimal($data['total']);

                        return $data;
                    })
                    ->mutateRelationshipDataBeforeSaveUsing(function (array $data): array {
                        $data['tenant_id'] = Filament::getTenant()->id;
                        $data['unit_price'] = FormatterHelper::toDecimal($data['unit_price']);
                        $data['discount'] = FormatterHelper::toDecimal($data['discount']);
                        $data['total'] = FormatterHelper::toDecimal($data['total']);

                        return $data;
                    })
                    ->addActionLabel('Adicionar Serviço')
                    ->reorderable()
                    ->collapsible()
                    ->cloneable()
                    ->defaultItems(0)
                    ->live()
                    ->afterStateUpdated(function ($get, $set): void {
                        self::recalculateTotals($get, $set);
                    })
                    ->columnSpanFull(),
            ]);
    }

    private static function getProductsSection(): Section
    {
        return Section::make('Produtos/Peças')
            ->description('Adicione os produtos e peças utilizados nesta ordem')
            ->afterHeader([
                Action::make('settings')
                    ->label('Configurar Produtos')
                    ->color('default')
                    ->outlined()
                    ->icon('heroicon-o-cog-6-tooth')
                    ->url(ProductResource::getUrl('index'))
                    ->openUrlInNewTab(true)
                    ->tooltip('Gerenciar Serviços'),
            ])
            ->icon('heroicon-o-cube')
            ->schema([
                Repeater::make('serviceOrderProducts')
                    ->relationship()
                    ->hiddenLabel()
                    ->compact(true)
                    ->table([
                        TableColumn::make('Produto'),
                        TableColumn::make('Qtd'),
                        TableColumn::make('Preço Unit.'),
                        TableColumn::make('Desconto'),
                        TableColumn::make('Total'),
                    ])
                    ->schema([
                        Select::make('product_id')
                            ->label('Produto')
                            ->placeholder('Selecione o produto')
                            ->options(fn () => Product::pluck('name', 'id'))
                            ->native(false)
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, $set, $get): void {
                                if ($state) {
                                    $product = Product::find($state);
                                    if ($product) {
                                        $set('product_name', $product->name);
                                        $set('unit_price', FormatterHelper::money($product->price_sale));
                                        $total = $product->price_sale;
                                        $set('total', FormatterHelper::money($total));
                                        self::recalculateTotals($get, $set);
                                    }
                                }
                            })
                            ->createOptionForm([
                                Section::make('Informações do Produto')
                                    ->schema(Product::getFormFields(useRelationship: false))
                                    ->columns(3)
                                    ->columnSpanFull(),
                            ])
                            ->createOptionUsing(function (array $data): int {
                                $product = Product::create([
                                    'tenant_id' => Filament::getTenant()->id,
                                    'name' => $data['name'],
                                    'category_id' => $data['category_id'] ?? null,
                                    'sku' => $data['sku'] ?? null,
                                    'price_cost' => FormatterHelper::toDecimal($data['price_cost'] ?? 0),
                                    'price_sale' => FormatterHelper::toDecimal($data['price_sale'] ?? 0),
                                ]);

                                return $product->id;
                            })
                            ->columnSpan(4),
                        Hidden::make('product_name'),
                        TextInput::make('quantity')
                            ->label('Qtd')
                            ->numeric()
                            ->default(1)
                            ->minValue(1)
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, $get, $set): void {
                                $unitPrice = FormatterHelper::toDecimal($get('unit_price'));
                                $discount = FormatterHelper::toDecimal($get('discount'));
                                $total = ($unitPrice * (int) $state) - $discount;
                                $set('total', FormatterHelper::money($total));
                                self::recalculateTotals($get, $set);
                            })
                            ->columnSpan(2),
                        PtbrMoney::make('unit_price')
                            ->label('Preço Unit.')
                            ->default('0,00')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, $get, $set): void {
                                $unitPrice = FormatterHelper::toDecimal($state);
                                $quantity = (int) $get('quantity');
                                $discount = FormatterHelper::toDecimal($get('discount'));
                                $total = ($unitPrice * $quantity) - $discount;
                                $set('total', FormatterHelper::money($total));
                                self::recalculateTotals($get, $set);
                            })
                            ->columnSpan(2),
                        PtbrMoney::make('discount')
                            ->label('Desconto')
                            ->default('0,00')
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, $get, $set): void {
                                $unitPrice = FormatterHelper::toDecimal($get('unit_price'));
                                $quantity = (int) $get('quantity');
                                $discount = FormatterHelper::toDecimal($state);
                                $total = ($unitPrice * $quantity) - $discount;
                                $set('total', FormatterHelper::money($total));
                                self::recalculateTotals($get, $set);
                            })
                            ->columnSpan(2),
                        PtbrMoney::make('total')
                            ->label('Total')
                            ->default('0,00')
                            ->disabled()
                            ->dehydrated()
                            ->columnSpan(2),
                    ])
                    ->columns(12)
                    ->mutateRelationshipDataBeforeCreateUsing(function (array $data): array {
                        $data['tenant_id'] = Filament::getTenant()->id;
                        $data['unit_price'] = FormatterHelper::toDecimal($data['unit_price']);
                        $data['discount'] = FormatterHelper::toDecimal($data['discount']);
                        $data['total'] = FormatterHelper::toDecimal($data['total']);

                        return $data;
                    })
                    ->mutateRelationshipDataBeforeSaveUsing(function (array $data): array {
                        $data['tenant_id'] = Filament::getTenant()->id;
                        $data['unit_price'] = FormatterHelper::toDecimal($data['unit_price']);
                        $data['discount'] = FormatterHelper::toDecimal($data['discount']);
                        $data['total'] = FormatterHelper::toDecimal($data['total']);

                        return $data;
                    })
                    ->addActionLabel('Adicionar Produto')
                    ->reorderable()
                    ->collapsible()
                    ->cloneable()
                    ->defaultItems(0)
                    ->live()
                    ->afterStateUpdated(function ($get, $set): void {
                        self::recalculateTotals($get, $set);
                    })
                    ->columnSpanFull(),
            ]);
    }

    private static function getValuesSection(): Section
    {
        return Section::make('Resumo Financeiro')
            ->description('Valores calculados automaticamente com base nos itens')
            ->icon('heroicon-o-calculator')
            ->schema([
                PtbrMoney::make('labor_value')
                    ->label('Valor da Mão de Obra (Serviços)')
                    ->default('0,00')
                    ->disabled()
                    ->dehydrated()
                    ->helperText('Calculado automaticamente com base nos serviços'),
                PtbrMoney::make('parts_value')
                    ->label('Valor das Peças (Produtos)')
                    ->default('0,00')
                    ->disabled()
                    ->dehydrated()
                    ->helperText('Calculado automaticamente com base nos produtos'),
                PtbrMoney::make('total_value')
                    ->label('Valor Total')
                    ->default('0,00')
                    ->disabled()
                    ->dehydrated(),
                TextInput::make('warranty_period')
                    ->label('Período de Garantia')
                    ->placeholder('Ex: 30 dias, 90 dias, 1 ano')
                    ->maxLength(50),
            ])
            ->columns(4);
    }

    private static function recalculateTotals($get, $set): void
    {
        // Calcular labor_value (serviços)
        $services = $get('serviceOrderServices') ?? [];
        $laborValue = 0;
        foreach ($services as $service) {
            if (isset($service['total'])) {
                $laborValue += FormatterHelper::toDecimal($service['total']);
            }
        }

        // Calcular parts_value (produtos)
        $products = $get('serviceOrderProducts') ?? [];
        $partsValue = 0;
        foreach ($products as $product) {
            if (isset($product['total'])) {
                $partsValue += FormatterHelper::toDecimal($product['total']);
            }
        }

        // Atualizar totais
        $set('labor_value', FormatterHelper::money($laborValue));
        $set('parts_value', FormatterHelper::money($partsValue));
        $set('total_value', FormatterHelper::money($laborValue + $partsValue));
    }
}
