<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTOs\VehicleData;
use App\Models\Vehicle;

final class VehicleRepository
{
    /**
     * Create a new vehicle
     */
    public function create(VehicleData $data): Vehicle
    {
        return Vehicle::create($data->toArray());
    }

    /**
     * Find a vehicle by plate and person
     */
    public function findByPlateAndPerson(string $plate, int $personId, int $tenantId): ?Vehicle
    {
        return Vehicle::query()
            ->where('plate', $plate)
            ->where('person_id', $personId)
            ->where('tenant_id', $tenantId)
            ->first();
    }

    /**
     * Find or create a vehicle
     */
    public function findOrCreate(VehicleData $data): Vehicle
    {
        $existing = $this->findByPlateAndPerson(
            $data->plate,
            $data->personId,
            $data->tenantId
        );

        if ($existing) {
            return $existing;
        }

        return $this->create($data);
    }

    /**
     * Get all vehicles for a person
     */
    public function getByPerson(int $personId, int $tenantId): \Illuminate\Database\Eloquent\Collection
    {
        return Vehicle::query()
            ->where('person_id', $personId)
            ->where('tenant_id', $tenantId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Update a vehicle
     */
    public function update(Vehicle $vehicle, VehicleData $data): Vehicle
    {
        $vehicle->update($data->toArray());

        return $vehicle->fresh();
    }

    /**
     * Delete a vehicle
     */
    public function delete(Vehicle $vehicle): bool
    {
        return $vehicle->delete();
    }
}
