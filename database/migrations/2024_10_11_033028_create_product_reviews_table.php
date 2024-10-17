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
        Schema::create('product_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id'); 
            $table->decimal('starRatings', 5, 2)->default(3);  // Decimal amount with 7 digits total and 2 decimal places, default 0
            $table->text('summary')->nullable(); // Product summary
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
        Schema::dropIfExists('product_reviews');
    }
};
