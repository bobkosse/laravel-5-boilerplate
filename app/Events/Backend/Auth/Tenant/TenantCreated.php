<?php

namespace App\Events\Backend\Auth\Tenant;

use Illuminate\Queue\SerializesModels;

/**
 * Class UserCreated.
 */
class TenantCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $tenant;

    /**
     * @param $user
     */
    public function __construct($tenant)
    {
        $this->tenant = $tenant;
    }
}
