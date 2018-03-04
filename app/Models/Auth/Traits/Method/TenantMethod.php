<?php

namespace App\Models\Auth\Traits\Method;
use Carbon\Carbon;

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
        $this->users()->forceDelete();

        // delete the tenant
        return parent::delete();
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->active == 1 && $this->end_subscription >= Carbon::today();
    }
}
