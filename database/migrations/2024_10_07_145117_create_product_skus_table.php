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
        Schema::create('product_skus', function (Blueprint $table) {
            $table->id();
            $table->integer('productUnitID');  // nullable, as integer
            $table->unsignedBigInteger('product_id'); 
            $table->unsignedBigInteger('size_attributes_id'); 
            $table->unsignedBigInteger('color_attributes_id'); 
            $table->string('sku')->nullable(); 
            $table->decimal('price', 11, 2)->default(0);  // Decimal amount with 7 digits total and 2 decimal places, default 0
            $table->decimal('offer_price', 11, 2)->default(0);  // Decimal amount with 7 digits total and 2 decimal places, default 0
            $table->decimal('descount_percentage', 7, 2)->default(0);  // Decimal amount with 7 digits total and 2 decimal places, default 0
            $table->integer('stock')->default(0);  // nullable, as integer
            $table->unsignedBigInteger('user_id')->default(0);  // nullable, as integer
            $table->unsignedBigInteger('store_id')->default(0);  // nullable, as integer
            $table->timestamps();
            $table->softDeletes();  // Soft delete column (deleted_at)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_skus');
    }
};
