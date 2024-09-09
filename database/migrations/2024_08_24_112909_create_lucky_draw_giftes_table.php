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
        Schema::create('lucky_draw_giftes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lucky_draws_id');  // Foreign key to lucky_draws table
            $table->string('name')->nullable();  // Lucky gift name, nullable
            $table->string('short_description')->nullable();  // Lucky short_description, nullable
            $table->string('description')->nullable();  // Lucky draw name, nullable
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
        Schema::dropIfExists('lucky_draw_giftes');
    }
};
