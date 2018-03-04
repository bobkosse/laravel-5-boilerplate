<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddMetadataToTenant extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tenants', function(Blueprint $table) {
           $table->boolean('active')->default(true)->after('tenant_name');
           $table->timestamp('end_subscription')->default(DB::raw('CURRENT_TIMESTAMP'))->after('active');
           $table->integer('max_users')->default(1)->after('end_subscription');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tenants', function(Blueprint $table) {
           $table->dropColumn(['active', 'end_subscription', 'max_users']);
        });
    }
}
