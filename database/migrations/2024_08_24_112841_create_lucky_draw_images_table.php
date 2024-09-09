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
        Schema::create('lucky_draw_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lucky_draws_id');  // Foreign key to lucky_draws table
            $table->string('images')->nullable();  // Store logo path, nullable
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
        Schema::dropIfExists('lucky_draw_images');
    }
};
