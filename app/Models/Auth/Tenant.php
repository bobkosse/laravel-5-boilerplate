<?php

namespace App\Models\Auth;

use App\Models\Auth\Traits\Attribute\TenantAttribute;
use App\Models\Auth\Traits\Method\TenantMethod;
use App\Models\Auth\Traits\Relationship\TenantRelationship;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tenant extends Model
{
    use SoftDeletes,
        TenantRelationship,
        TenantAttribute,
        TenantMethod,
        Uuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tenant_name',
    ];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];
}
