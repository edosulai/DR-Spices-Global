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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('recipent');
            $table->string('street');
            $table->string('other_street');
            $table->string('district');
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            // $table->foreignId('country_id')->constrained('countries')->onDelete('cascade');
            $table->string('country');
            $table->string('phone');
            $table->boolean('primary')->default(false);
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
        Schema::dropIfExists('addresses');
    }
};
