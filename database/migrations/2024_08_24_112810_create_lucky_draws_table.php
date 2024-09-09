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
        Schema::create('lucky_draws', function (Blueprint $table) {
            $table->id();  // Auto-incrementing ID
            $table->string('code')->nullable();  // Lucky draw code, nullable
            $table->string('name')->nullable();  // Lucky draw name, nullable
            $table->date('draw_date')->nullable();  // Draw date, nullable
            $table->string('video')->nullable();  // Video file path, nullable
            $table->string('youtube_link')->nullable();  // YouTube link, nullable
            $table->enum('status', ['active', 'inactive'])->default('active');  // Status column with enum type, default 'active'
            $table->timestamps();  // created_at and updated_at
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
        Schema::dropIfExists('lucky_draws');
    }
};
