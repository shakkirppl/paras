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
        Schema::table('temp_product_images', function (Blueprint $table) {
            //
            $table->integer('product_sku_id');  // nullable, as integer
            $table->unsignedBigInteger('product_id'); 
            $table->string('image')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('temp_product_images', function (Blueprint $table) {
            //
        });
    }
};
