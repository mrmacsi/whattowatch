<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shows', function (Blueprint $table) {
            $table->id();
            $table->string('show_id')->unique()->index();
            $table->text('pic_src')->nullable();
            $table->text('video_src')->nullable();
            $table->text('quality_pic_src')->nullable();
            $table->string('title');
            $table->string('duration')->nullable();
            $table->string('genre')->nullable();
            $table->string('rating')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('shows');
    }
};
