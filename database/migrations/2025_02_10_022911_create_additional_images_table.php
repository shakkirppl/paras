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
        Schema::create('additional_images', function (Blueprint $table) {
            //
            $table->id();
            $table->unsignedBigInteger('offers_id'); // Foreign key to relate images with products
            $table->integer('store_id')->default(0);  // nullable, as integer
            $table->string('image');
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
        Schema::table('additional_images', function (Blueprint $table) {
            //
        });
    }
};
