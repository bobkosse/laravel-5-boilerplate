<?php

namespace App\Models\Auth\Traits\Relationship;

use App\Models\System\Session;
use App\Models\Auth\User;

/**
 * Class UserRelationship.
 */
trait TenantRelationship
{
    public function users() {
        return $this->hasMany(User::class);
    }
}
