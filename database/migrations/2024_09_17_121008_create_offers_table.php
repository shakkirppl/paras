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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();  // title name, nullable
            $table->string('short_description')->nullable();  // title name, nullable
            $table->string('highlight_title')->nullable();  // title name, nullable
            $table->unsignedBigInteger('categories_id');  // Foreign key to categories table
            $table->unsignedBigInteger('sub_categories_id');  // Foreign key to categories table
            $table->unsignedBigInteger('offer_categories_id');  // Foreign key to categories table
            $table->string('applicable_on')->nullable();  // title name, nullable
            $table->decimal('descount_percentage', 7, 2)->default(0);  // Decimal amount with 7 digits total and 2 decimal places, default 0
            $table->string('image')->nullable();  // title name, nullable
            $table->date('in_date')->nullable();  // Draw date, nullable
            $table->longText('description')->nullable();  // title name, nullable
            $table->date('start_date')->nullable();  // Draw date, nullable
            $table->date('end_date')->nullable();  // Draw date, nullable
            $table->longText('tags')->nullable();  // title name, nullable
            $table->integer('user_id')->default(0);  // nullable, as integer
            $table->integer('store_id')->default(0);  // nullable, as integer
            $table->integer('offer_like')->default(0);  // nullable, as integer
            $table->integer('offer_deslike')->default(0);  // nullable, as integer
            $table->integer('no_of_use')->default(0);  // nullable, as integer
            $table->integer('views')->default(0);  // nullable, as integer
            $table->integer('hot_deal')->default(0);  // nullable, as integer
            $table->integer('trending')->default(0);  // nullable, as integer
            $table->integer('promote')->default(0);  // nullable, as integer
            $table->enum('verified', ['yes', 'no'])->default('no'); 
            $table->enum('status', ['active', 'inactive'])->default('active'); 
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
        Schema::dropIfExists('offers');
    }
};
