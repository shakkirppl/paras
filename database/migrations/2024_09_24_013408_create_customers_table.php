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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->string('password');
            $table->integer('user_id')->default(0);  // nullable, as integer
            $table->integer('total_point')->default(0);  // nullable, as integer
            $table->integer('spend_point')->default(0);  // nullable, as integer
            $table->integer('current_point')->default(0);  // nullable, as integer
            $table->decimal('total_purchase_amount', 9, 2)->default(0);  // Decimal amount with 9 digits total and 2 decimal places, default 0
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
        Schema::dropIfExists('customers');
    }
};
