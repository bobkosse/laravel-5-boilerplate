<?php

namespace App\Events\Backend\Auth\Tenant;

use Illuminate\Queue\SerializesModels;

/**
 * Class TenantUpdated.
 */
class TenantUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $tenant;

    /**
     * @param $tenant
     */
    public function __construct($tenant)
    {
        $this->tenant = $tenant;
    }
}
