<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('crm_customers', function (Blueprint $table) {
            $table->string('verify_employee_count')->nullable();
            $table->string('erc_advance')->nullable();
        });
    }

    public function down()
    {
        Schema::table('crm_customers', function (Blueprint $table) {
            //
            $table->dropColumn('verify_employee_count');
            $table->dropColumn('erc_advance');
        });
    }
};
