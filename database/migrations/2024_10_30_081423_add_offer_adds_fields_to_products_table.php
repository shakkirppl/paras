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
        Schema::table('offer_adds', function (Blueprint $table) {
            //
            $table->string('offer_adds_type')->default('add1');  // Status column with enum type
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offer_adds', function (Blueprint $table) {
            //
        });
    }
};
