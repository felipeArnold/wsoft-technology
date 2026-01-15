<?php

declare(strict_types=1);

namespace App\Models;

use App\Enum\TenantType;
use App\Models\Asaas\AsaasAccount;
use App\Models\Person\Addresses;
use App\Models\Person\Emails;
use App\Models\Person\Phones;
use App\Observers\TenantObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Cashier\Billable;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $avatar
 * @property string|null $document
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $mobile
 * @property string|null $zip_code
 * @property string|null $street
 * @property string|null $number
 * @property string|null $complement
 * @property string|null $neighborhood
 * @property string|null $city
 * @property string|null $state
 * @property string|null $website
 * @property TenantType $type
 * @property int $max_users
 * @property string|null $stripe_id
 * @property string|null $pm_type
 * @property string|null $pm_last_four
 * @property Carbon|null $trial_ends_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
#[ObservedBy(TenantObserver::class)]
final class Tenant extends Model
{
    use Billable;
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'slug',
        'avatar',
        'document',
        'email',
        'phone',
        'mobile',
        'zip_code',
        'street',
        'number',
        'complement',
        'neighborhood',
        'city',
        'state',
        'website',
        'type',
        'max_users',
        'stripe_id',
        'pm_type',
        'pm_last_four',
        'trial_ends_at',
    ];

    protected $casts = [
        'type' => TenantType::class,
        'trial_ends_at' => 'datetime',
    ];

    public static function generateUniqueSlug(string $name): string
    {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug;
        $counter = 1;

        while (self::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        return $slug;
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function emailTemplates(): HasMany
    {
        return $this->hasMany(EmailTemplate::class);
    }

    public function phones(): MorphMany
    {
        return $this->morphMany(Phones::class, 'phonable');
    }

    public function addresses(): MorphMany
    {
        return $this->morphMany(Addresses::class, 'addressable');
    }

    public function emails(): MorphMany
    {
        return $this->morphMany(Emails::class, 'emailable');
    }

    public function asaasAccount(): HasOne
    {
        return $this->hasOne(AsaasAccount::class);
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return Storage::url($this->avatar);
    }

    /**
     * Check if this tenant is eligible for a free trial
     * Prevents abuse by checking multiple anti-fraud rules
     */
    public function isEligibleForTrial(?User $user = null): bool
    {
        // Rule 1: Tenant already had a subscription/trial
        // This includes active subscriptions, canceled (ends_at filled), or any subscription record
        // We check subscriptions table directly to catch all cases
        if ($this->subscriptions()->exists()) {
            return false;
        }

        // Additional check: Tenant has trial_ends_at filled (from webhook)
        // This catches cases where subscription was created but might not be in subscriptions table yet
        if ($this->trial_ends_at !== null) {
            return false;
        }

        // Rule 2: User already had trial in another tenant
        // Check both: tenant's trial_ends_at field AND subscriptions table
        if ($user) {
            $userTenantIds = $user->tenants()->pluck('id');

            // Check if any other tenant has trial_ends_at filled
            $userHadTrialBefore = self::whereIn('id', $userTenantIds)
                ->whereNotNull('trial_ends_at')
                ->exists();

            // Also check if user's other tenants have any subscriptions (active or canceled)
            $userHadSubscriptionBefore = self::whereIn('id', $userTenantIds)
                ->whereHas('subscriptions')
                ->exists();

            if ($userHadTrialBefore || $userHadSubscriptionBefore) {
                return false;
            }
        }

        // Rule 3: Document (CPF/CNPJ) already used in another trial
        // Check both: trial_ends_at field AND subscriptions table
        if ($this->document) {
            // Check if document was used in another tenant with trial_ends_at
            $documentHadTrialBefore = self::where('document', $this->document)
                ->where('id', '!=', $this->id)
                ->whereNotNull('trial_ends_at')
                ->exists();

            // Also check if document was used in tenant with any subscription (active or canceled)
            $documentHadSubscriptionBefore = self::where('document', $this->document)
                ->where('id', '!=', $this->id)
                ->whereHas('subscriptions')
                ->exists();

            if ($documentHadTrialBefore || $documentHadSubscriptionBefore) {
                return false;
            }
        }

        return true;
    }

    /**
     * Check if tenant ever had a trial (even if canceled)
     * This is useful to prevent re-enabling trials on existing subscriptions
     */
    public function hasEverHadTrial(): bool
    {
        // Check tenant's trial_ends_at field
        if ($this->trial_ends_at !== null) {
            return true;
        }

        // Check if any subscription has trial_ends_at filled
        return $this->subscriptions()
            ->whereNotNull('trial_ends_at')
            ->exists();
    }

    /**
     * Check if tenant has any subscription (active or canceled)
     */
    public function hasEverHadSubscription(): bool
    {
        return $this->subscriptions()->exists();
    }
}
