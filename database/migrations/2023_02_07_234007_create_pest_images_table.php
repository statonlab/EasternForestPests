<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pest_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('path');
            $table->double('size');
            $table->string('disk')->default('images')->index();
            $table->json('data')->nullable();
            $table->text('caption')->nullable();
            $table->boolean('is_thumbnail')->nullable();
            $table->foreignId('pest_id')->nullable()->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('pest_images');
    }
};
