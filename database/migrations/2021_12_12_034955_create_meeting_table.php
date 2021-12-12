<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('work_name');
            $table->timestamp('start_at');
            $table->string('email');
            $table->longText('content');
            $table->longText('zoom_meeting_id');
            $table->longText('zoom_join_url');
            $table->longText('zoom_start_url');
            $table->longText('zoom_password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meeting');
    }
}
