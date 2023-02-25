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
        Schema::create('pests', function (Blueprint $table) {
            $table->id();
            $table->string('description')->nullable();
            $table->foreignId('chapter_id')->constrained()->cascadeOnDelete();
            $table->string('pest_type')->nullable();
            $table->boolean('is_pest')->nullable();
            $table->boolean('is_disease')->nullable();
            $table->boolean('affects_deciduous')->nullable();
            $table->boolean('affects_conifer')->nullable();
            $table->string('visible_in_roots')->nullable();
            $table->string('visible_in_trunk')->nullable();
            $table->string('visible_in_foliage')->nullable();
            $table->string('feeding_target')->nullable();
            $table->string('major_hosts')->nullable();
            $table->string('key_features')->nullable();
            $table->string('control')->nullable();
            $table->string('other_info_title')->nullable();
            $table->string('other_info_body')->nullable();
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
        Schema::dropIfExists('pests');
    }
};
