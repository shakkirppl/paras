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
        Schema::create('lucky_draw_winners', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lucky_draws_id');  // Foreign key to lucky_draws table
            $table->unsignedBigInteger('winner_id');  // Foreign key to customer table
            $table->string('name')->nullable();  // Lucky  name, nullable
            $table->string('address')->nullable();  // Lucky  name, nullable
            $table->string('contact')->nullable();  // Lucky  name, nullable
            $table->string('image')->nullable();  // Lucky  name, nullable
            $table->string('district')->nullable();  // Lucky  name, nullable
            $table->unsignedBigInteger('lucky_draw_giftes_id');  // Foreign key to customer table
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lucky_draw_winners');
    }
};
