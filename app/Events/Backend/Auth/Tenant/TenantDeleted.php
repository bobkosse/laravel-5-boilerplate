<?php

namespace App\Events\Backend\Auth\Tenant;

use Illuminate\Queue\SerializesModels;

/**
 * Class RoleDeleted.
 */
class TenantDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $tenant;

    /**
     * @param $role
     */
    public function __construct($tenant)
    {
        $this->tenant = $tenant;
    }
}
