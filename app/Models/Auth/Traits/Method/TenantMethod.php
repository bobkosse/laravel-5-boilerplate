<?php

namespace App\Models\Auth\Traits\Method;

/**
 * Trait UserMethod.
 */
/**
 * Class TenantMethod
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

        // delete the user
        return parent::delete();
    }
}
