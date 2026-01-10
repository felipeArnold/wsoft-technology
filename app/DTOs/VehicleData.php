<?php

declare(strict_types=1);

namespace App\DTOs;

final readonly class VehicleData
{
    public function __construct(
        public int $tenantId,
        public int $personId,
        public string $plate,
        public string $brand,
        public string $model,
        public ?int $year = null,
        public ?string $color = null,
        public ?string $chassis = null,
        public ?string $renavam = null,
        public ?string $notes = null,
    ) {}

    /**
     * Create from array data
     */
    public static function fromArray(array $data, int $tenantId, int $personId): self
    {
        return new self(
            tenantId: $tenantId,
            personId: $personId,
            plate: $data['plate'],
            brand: $data['brand'],
            model: $data['model'],
            year: isset($data['year']) ? (int) $data['year'] : null,
            color: $data['color'] ?? null,
            chassis: $data['chassis'] ?? null,
            renavam: $data['renavam'] ?? null,
            notes: $data['notes'] ?? null,
        );
    }

    /**
     * Convert to array for database insertion
     */
    public function toArray(): array
    {
        return [
            'tenant_id' => $this->tenantId,
            'person_id' => $this->personId,
            'plate' => $this->plate,
            'brand' => $this->brand,
            'model' => $this->model,
            'year' => $this->year,
            'color' => $this->color,
            'chassis' => $this->chassis,
            'renavam' => $this->renavam,
            'notes' => $this->notes,
        ];
    }
}
