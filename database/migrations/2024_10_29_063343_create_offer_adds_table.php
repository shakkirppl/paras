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
        Schema::create('offer_adds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('offer_categories_id')->default(0);
            $table->text('description')->nullable();  // Coupon name, nullable
            $table->string('image')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');  // Status column with enum type
            $table->timestamps();
            $table->softDeletes(); // deleted_at for soft deletes
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offer_adds');
    }
};
