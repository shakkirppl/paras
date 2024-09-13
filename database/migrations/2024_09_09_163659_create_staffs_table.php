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
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();  // Coupon code, nullable
            $table->string('name')->nullable();  // Coupon name, nullable
            $table->string('image')->nullable();  // Coupon code, nullable
            $table->string('address')->nullable();  // Coupon name, nullable
            $table->string('email')->nullable();  // Coupon code, nullable
            $table->string('contact_no')->nullable();  // Coupon name, nullable
            $table->string('whatsapp_no')->nullable();  // Coupon code, nullable
            $table->string('username')->nullable();  // Coupon name, nullable
            $table->string('password')->nullable();  // Coupon code, nullable
            $table->string('description')->nullable();  // Coupon name, nullable
            $table->date('date_of_joining')->nullable();  // Subscription end date, nullable
            $table->unsignedBigInteger('districts_id');  // Foreign key to districts table
            $table->enum('status', ['active', 'inactive'])->default('active');  // Status column with enum type
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
        Schema::dropIfExists('staffs');
    }
};
