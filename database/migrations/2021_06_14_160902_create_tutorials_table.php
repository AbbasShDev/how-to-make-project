<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutorials', function (Blueprint $table) {
            $table->id();
            $table->uuid("uuid");
            $table->foreignId("user_id")->constrained()->cascadeOnDelete();
            $table->string("title");
            $table->text("main_image");
            $table->text("description");
            $table->string("difficulty");
            $table->double("duration");
            $table->string("duration_measurement");
            $table->string("area");
            $table->text("introduction")->nullable();
            $table->string("introduction_video")->nullable();
            $table->tinyText("tutorial_status");
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
        Schema::dropIfExists('tutorials');
    }
}
