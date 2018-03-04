<?php

namespace App\Models\Auth\Traits\Relationship;

use App\Models\System\Session;
use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Trait TenantRelationship.
 */
trait TenantRelationship
{
    /**
     * User relationship
     * @return HasMany
     */
    public function users(): HasMany {
        return $this->hasMany(User::class)->withoutGlobalScopes();
    }
}
