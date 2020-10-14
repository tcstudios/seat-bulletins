<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Initial extends Migration {
    public function up() {
        Schema::create('seat_bulletin', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('author_id');
            $table->string('character_name');
            $table->string('title');
            $table->text('text');
            $table->timestamps();
        });
        Schema::create('seat_bulletin_role', function(Blueprint $table) {
            $table->unsignedInteger('bulletin_id');
            $table->unsignedInteger('role_id');
        });
    }
    public function down() {
        Schema::dropIfExists('seat_bulletin');
        Schema::dropIfExists('seat_bulletin_role');
    }
}