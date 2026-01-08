<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Observers\UserObserver;
use App\Services\Onboarding\OnboardingService;
use Database\Factories\UserFactory;
use Filament\Auth\MultiFactor\Email\Contracts\HasEmailAuthentication;
use Filament\Facades\Filament;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id
 * @property string|null $avatar
 * @property string $name
 * @property string $email
 * @property string|null $phone
 * @property Carbon|null $email_verified_at
 * @property mixed $password
 * @property string $role
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 */
#[ObservedBy(UserObserver::class)]
final class User extends Authenticatable implements FilamentUser, HasAvatar, HasEmailAuthentication, HasTenants
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'avatar',
        'has_email_authentication',
        'commission_percentage',
        'is_activated',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getTenants(Panel $panel): Collection
    {
        return $this->tenants;
    }

    public function tenants(): BelongsToMany
    {
        return $this->belongsToMany(Tenant::class);
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'team_user')
            ->withTimestamps();
    }

    public function canAccessTenant(Model $tenant): bool
    {
        return $this->tenants->contains($tenant);
    }

    public function tenant(): BelongsToMany
    {
        return $this->tenants()->where('tenant_id', Filament::getTenant()->getAttribute('id'));
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar ? Storage::providesTemporaryUrls()
            ? Storage::temporaryUrl(
                $this->avatar,
                now()->addMinutes(config('filament.models.user.avatar_url_expiration', 5)),
            )
            : Storage::url($this->avatar) : null;
    }

    public function hasEmailAuthentication(): bool
    {
        // This method should return true if the user has enabled email authentication.

        return $this->has_email_authentication;
    }

    public function toggleEmailAuthentication(bool $condition): void
    {
        // This method should save whether or not the user has enabled email authentication.

        $this->has_email_authentication = $condition;
        $this->save();
    }

    public function commissions(): HasMany
    {
        return $this->hasMany(Commission::class);
    }

    public function serviceOrders(): HasMany
    {
        return $this->hasMany(ServiceOrder::class);
    }

    public function onboardingSteps(): HasMany
    {
        return $this->hasMany(UserOnboardingStep::class);
    }

    public function getOnboardingProgress(): float
    {
        $totalSteps = 6; // Total de steps obrigatórios
        $completedSteps = $this->onboardingSteps()->where('completed', true)->count();

        return $totalSteps > 0 ? ($completedSteps / $totalSteps) * 100 : 0;
    }

    public function hasCompletedOnboarding(): bool
    {
        return $this->getOnboardingProgress() === 100.0;
    }

    public function checkAndActivate(): void
    {
        $requiredSteps = OnboardingService::getActivationRequiredStepIds();

        $completedRequired = $this->onboardingSteps()
            ->whereIn('step_id', $requiredSteps)
            ->where('completed', true)
            ->count();

        if ($completedRequired === count($requiredSteps) && ! $this->is_activated) {
            $this->update(['is_activated' => true]);
        }
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'has_email_authentication' => 'boolean',
            'commission_percentage' => 'decimal:2',
            'is_activated' => 'boolean',
        ];
    }
}
