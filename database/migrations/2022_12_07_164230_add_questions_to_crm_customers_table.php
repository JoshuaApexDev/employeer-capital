<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('crm_customers', function (Blueprint $table) {
            $table->string('company_name')->nullable();
            $table->string('was_your_business_operational')->nullable();
            $table->string('full_time_operational_employees')->nullable();
            $table->string('hm_w2_employees')->nullable();
            $table->string('is_your_business_a_restaurant')->nullable();
            $table->json('periods_when_suspended')->nullable();
            $table->string('quarter_with_declined_gross')->nullable();
            $table->string('q1_2021_vs_q1_2019')->nullable();
            $table->string('q3_2021_vs_q3_2019')->nullable();
            $table->string('q2_2021_vs_q2_2019')->nullable();
            $table->string('q4_2021_vs_q4_2019')->nullable();
            $table->string('total_dollar_amount_ppp_loan_received_2020')->nullable();
            $table->string('total_dollar_amount_ppp_loan_received_2021')->nullable();
            $table->string('total_payroll_2020')->nullable();
        });
    }

    public function down()
    {
        Schema::table('crm_customers', function (Blueprint $table) {
            $table->dropColumn('was_your_business_operational');
            $table->dropColumn('full_time_operational_employees');
            $table->dropColumn('hm_w2_employees');
            $table->dropColumn('is_your_business_a_restaurant');
            $table->dropColumn('periods_when_suspended');
            $table->dropColumn('quarter_with_declined_gross');
            $table->dropColumn('q1_2021_vs_q1_2019');
            $table->dropColumn('q3_2021_vs_q3_2019');
            $table->dropColumn('q2_2021_vs_q2_2019');
            $table->dropColumn('q4_2021_vs_q4_2019');
            $table->dropColumn('total_dollar_amount_ppp_loan_received_2020');
            $table->dropColumn('total_dollar_amount_ppp_loan_received_2021');
            $table->dropColumn('total_payroll_2020');
        });
    }
};
