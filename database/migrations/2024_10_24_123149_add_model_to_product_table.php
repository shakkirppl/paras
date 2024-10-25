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
        Schema::table('temp_products', function (Blueprint $table) {
            //
            $table->string('model')->nullable()->after('product_slug'); 
            $table->string('extra_1')->nullable()->after('model');  
            $table->string('extra_2')->nullable()->after('extra_1');  
            $table->string('extra_3')->nullable()->after('extra_2'); 
            $table->string('extra_4')->nullable()->after('extra_3');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('temp_products', function (Blueprint $table) {
            //
        });
    }
};
