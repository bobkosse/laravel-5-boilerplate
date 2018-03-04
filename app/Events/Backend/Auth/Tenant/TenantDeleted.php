<?php

namespace App\Events\Backend\Auth\Tenant;

use Illuminate\Queue\SerializesModels;

/**
 * Class TenantDeleted.
 */
class TenantDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $tenant;

    /**
     * @param Tenant
     */
    public function __construct($tenant)
    {
        $this->tenant = $tenant;
    }
}
