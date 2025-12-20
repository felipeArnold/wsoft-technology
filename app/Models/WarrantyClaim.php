<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

final class WarrantyClaim extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'tenant_id',
        'warranty_id',
        'resolution_service_order_id',
        'user_id',
        'assigned_technician_id',
        'approved_by_user_id',
        'claim_number',
        'claim_date',
        'issue_description',
        'resolution_description',
        'rejection_reason',
        'status',
        'priority',
        'defect_type',
        'approved_at',
        'started_at',
        'resolved_at',
        'labor_cost',
        'parts_cost',
        'additional_cost',
        'covered_by_warranty',
        'replaced_parts',
        'attachments',
        'customer_feedback',
        'customer_rating',
        'notes',
    ];

    protected $casts = [
        'claim_date' => 'date',
        'approved_at' => 'datetime',
        'started_at' => 'datetime',
        'resolved_at' => 'datetime',
        'labor_cost' => 'decimal:2',
        'parts_cost' => 'decimal:2',
        'additional_cost' => 'decimal:2',
        'covered_by_warranty' => 'boolean',
        'replaced_parts' => 'array',
        'attachments' => 'array',
        'customer_rating' => 'integer',
    ];

    // Relationships

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function warranty(): BelongsTo
    {
        return $this->belongsTo(Warranty::class);
    }

    public function resolutionServiceOrder(): BelongsTo
    {
        return $this->belongsTo(ServiceOrder::class, 'resolution_service_order_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function assignedTechnician(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_technician_id');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by_user_id');
    }

    // Helper Methods

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    public function isInProgress(): bool
    {
        return $this->status === 'in_progress';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function getDaysOpen(): int
    {
        $endDate = $this->resolved_at ?? now();

        return (int) $this->claim_date->diffInDays($endDate);
    }

    public function getTotalCost(): float
    {
        return (float) ($this->labor_cost + $this->parts_cost + $this->additional_cost);
    }

    public function getResponseTime(): ?int
    {
        if (! $this->started_at) {
            return null;
        }

        return (int) $this->claim_date->diffInHours($this->started_at);
    }

    public function getResolutionTime(): ?int
    {
        if (! $this->resolved_at) {
            return null;
        }

        return (int) $this->claim_date->diffInHours($this->resolved_at);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopeHighPriority($query)
    {
        return $query->whereIn('priority', ['high', 'urgent']);
    }
}
