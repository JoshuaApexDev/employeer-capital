<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelnyxCallEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telnyx_call_entries', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('main_control_id');
            $table->string('child_control_id')->nullable();
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->string('sip_to')->nullable();
            $table->json('main_call_json');
            $table->json('child_call_json')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telnyx_call_entries');
    }
}
