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
        Schema::create('request_buys', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('invoice');
            $table->foreignUuid('user_id')->constrained('users')->onDelete('cascade');
            $table->json('spice_data');
            $table->foreignUuid('status_id')->constrained('statuses')->onDelete('cascade');
            $table->integer('jumlah');
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
        Schema::dropIfExists('request_buys');
    }
};
