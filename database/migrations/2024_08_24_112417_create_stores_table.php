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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();  // Store code, nullable
            $table->string('name')->nullable();  // Store name, nullable
            $table->unsignedBigInteger('store_types_id');  // Foreign key to store_types table
            $table->unsignedBigInteger('store_classifications_id');  // Foreign key to store_classifications table
            $table->unsignedBigInteger('district_id');  // Foreign key to districts table
            $table->string('logo')->nullable();  // Store logo path, nullable
            $table->string('email')->nullable();  // Store email, nullable
            $table->string('contact_no', 15)->nullable();  // Contact number, nullable, with max length 15
            $table->string('whatsapp_no', 15)->nullable();  // WhatsApp number, nullable, with max length 15
            $table->text('address')->nullable();  // Store address, nullable, using text for longer addresses
            $table->string('town')->nullable();  // Town, nullable
            $table->string('landmark')->nullable();  // Landmark, nullable
            $table->decimal('star_rating', 2, 1)->nullable();  // Star rating, nullable, with 2 digits, 1 decimal point
            $table->decimal('latitude', 10, 7)->nullable();  // Latitude, nullable, with precision 10, scale 7
            $table->decimal('longitude', 10, 7)->nullable();  // Longitude, nullable, with precision 10, scale 7
            $table->date('subscription_end_date')->nullable();  // Subscription end date, nullable
            $table->integer('buffer_days')->nullable();  // Buffer days, nullable, as integer
            $table->string('admin_user_name')->nullable();  // Admin username, nullable
            $table->string('password')->nullable();  // Password, nullable
            $table->text('description')->nullable();  // Store description, nullable
            $table->enum('status', ['active', 'inactive'])->default('active');  // Status column with enum type
            $table->timestamps();  // Created_at and updated_at
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
        Schema::dropIfExists('stores');
    }
};
