<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrmCustomersTable extends Migration
{
    public function up()
    {
        Schema::create('crm_customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('cellphone')->nullable();
            $table->string('other_phone')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('file_code')->nullable();
            $table->string('w2_employees')->nullable();
            $table->string('receive_erc')->nullable();
            $table->string('ppp_loan')->nullable();
            $table->string('employee_count')->nullable();
            $table->string('first_name_verified')->nullable();
            $table->string('last_name_verified')->nullable();
            $table->string('custom_field_1')->nullable();
            $table->string('custom_field_2')->nullable();
            $table->string('custom_field_3')->nullable();
            $table->string('custom_field_4')->nullable();
            $table->string('custom_field_5')->nullable();
            $table->string('custom_field_6')->nullable();
            $table->string('custom_field_7')->nullable();
            $table->string('custom_field_8')->nullable();
            $table->string('custom_field_9')->nullable();
            $table->string('custom_field_10')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
