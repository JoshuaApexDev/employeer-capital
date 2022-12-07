<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('crm_customers', function (Blueprint $table) {
            $table->string('erc_amount')->nullable();
            $table->string('deal_revenue')->nullable();
            $table->string('contingency_fee')->nullable();
            $table->string('employee_amount')->nullable();
            $table->string('payroll_amount')->nullable();

        });
    }

    public function down()
    {
        Schema::table('crm_customers', function (Blueprint $table) {
            $table->dropColumn('erc_amount');
            $table->dropColumn('deal_revenue');
            $table->dropColumn('contingency_fee');
            $table->dropColumn('employee_amount');
            $table->dropColumn('payroll_amount');

        });
    }
};
