<?php

namespace App\Models\Auth\Traits\Method;

/**
 * Trait TenantMethod
 * @package App\Models\Auth\Traits\Method
 */
trait TenantMethod
{
    /**
     * Remove all records related to this tenant
     *
     * @return mixed
     */
    public function delete()
    {
        $this->users()->delete();

        // delete the tenant
        return parent::delete();
    }
}
