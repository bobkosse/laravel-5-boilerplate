<?php

use App\Models\Tenant\Tenant;
use Illuminate\Database\Seeder;

/**
 * Class UserTableSeeder.
 */
class TenantTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Add the firt tenant with id 1
        Tenant::create([
            'id'                => 1,
            'tenant_name'       => 'Demo tenant'
        ]);

        $this->enableForeignKeys();
    }
}
