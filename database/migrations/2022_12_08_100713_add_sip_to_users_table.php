<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('sip_extension')->nullable();
            $table->string('sip_password')->nullable();
            $table->string('sip_server')->nullable();
            $table->string('sip_port')->nullable();
            $table->boolean('sip_enabled')->default(0);
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('sip_extension');
            $table->dropColumn('sip_password');
            $table->dropColumn('sip_server');
            $table->dropColumn('sip_port');
            $table->dropColumn('sip_enabled');
        });
    }
};
