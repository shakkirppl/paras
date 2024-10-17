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
        
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->string('name'); // Product name
                $table->string('product_code')->nullable(); 
                $table->string('product_slug')->nullable(); 
                $table->decimal('starRatings', 5, 2)->default(3);  // Decimal amount with 7 digits total and 2 decimal places, default 0
                $table->text('description')->nullable(); // Product description
                $table->text('summary')->nullable(); // Product summary
                $table->string('cover')->nullable(); // Product cover image
                $table->unsignedBigInteger('brand_id'); // Foreign key for category
                $table->unsignedBigInteger('category_id'); // Foreign key for category
                $table->unsignedBigInteger('sub_category_id'); // Foreign key for category
                $table->enum('featured', ['yes', 'no'])->default('no'); 
                $table->enum('hotdeal', ['yes', 'no'])->default('no'); 
                $table->enum('offer', ['yes', 'no'])->default('no');
                $table->enum('status', ['active', 'inactive'])->default('active'); 
                $table->unsignedBigInteger('user_id')->default(0);  // nullable, as integer
                $table->unsignedBigInteger('store_id')->default(0);  // nullable, as integer
                $table->timestamps(); // created_at and updated_at
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
        Schema::dropIfExists('products');
    }
};
