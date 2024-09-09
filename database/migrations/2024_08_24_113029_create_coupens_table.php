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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();  // Auto-incrementing ID
            $table->string('code')->nullable();  // Coupon code, nullable
            $table->string('name')->nullable();  // Coupon name, nullable
            $table->decimal('amount', 7, 2)->default(0);  // Decimal amount with 7 digits total and 2 decimal places, default 0
            $table->integer('point')->default(0);  // Integer points, default 0
            $table->timestamps();  // created_at and updated_at columns
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
        Schema::dropIfExists('coupens');
    }
};
