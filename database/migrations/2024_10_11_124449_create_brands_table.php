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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();  // Coupon code, nullable
            $table->string('name')->nullable();  // Coupon name, nullable
            $table->string('image')->nullable();
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
        Schema::dropIfExists('brands');
    }
};
