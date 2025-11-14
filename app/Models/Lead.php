<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Lead extends Model
{
    protected $fillable = [
        // Campos principais (genéricos)
        'name',
        'email',
        'phone',
        'company_name',
        'source',
        'status',
        'notes',

        // Campos de tracking/marketing
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_term',
        'utm_content',

        // Campos adicionais
        'message',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
