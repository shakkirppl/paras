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
        Schema::create('offer_adds_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('master_id'); 
            $table->unsignedBigInteger('product_id'); 
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
        Schema::dropIfExists('offer_adds_details');
    }
};
