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
        Schema::create('spice_images', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('spice_id')->constrained('spices')->onDelete('cascade');
            $table->string('image');
            $table->timestamps(6);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spice_images');
    }
};
