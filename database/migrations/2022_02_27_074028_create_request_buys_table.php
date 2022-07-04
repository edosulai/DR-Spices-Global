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
            $table->json('maggot_data');
            $table->json('transaction_data');
            $table->enum('refund', [0, 1, 2])->default(0);
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
        Schema::dropIfExists('request_buys');
    }
};
