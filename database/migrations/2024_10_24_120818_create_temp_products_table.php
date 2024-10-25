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
        Schema::create('temp_products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Product name
                $table->string('product_code')->nullable(); 
                $table->string('product_slug')->nullable(); 
                $table->text('description')->nullable(); // Product description
                $table->text('summary')->nullable(); // Product summary
                $table->string('cover')->nullable(); // Product cover image
                $table->unsignedBigInteger('brand_id'); // Foreign key for category
                $table->unsignedBigInteger('category_id'); // Foreign key for category
                $table->unsignedBigInteger('sub_category_id'); // Foreign key for category
                $table->enum('status', ['active', 'inactive'])->default('active'); 
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
        Schema::dropIfExists('temp_products');
    }
};
