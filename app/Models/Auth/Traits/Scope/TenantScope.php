<?php
namespace App\Models\Auth\Traits\Scope;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class TenantScope
 * @package App\Models\Auth\Traits\Scope
 */
trait TenantScope
{
    /**
     * Add tenant scope to models
     */
    public static function bootTenantScope()
    {
        if(! app()->runningInConsole()) {

            static::addGlobalScope('tenant_id', function (Builder $builder) {
                $tenantId = session('tenant_id');
                if(is_null($tenantId)) {
                    return;
                }

                $builder->where('tenant_id',  $tenantId);
            });
        }
    }
}