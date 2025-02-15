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
        Schema::table('store_classifications', function (Blueprint $table) {
            //
            $table->string('Identity')->nullable()->after('maximum_sales');
            $table->string('classic_option')->nullable()->after('Identity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('store_classifications', function (Blueprint $table) {
            //
            $table->dropColumn(['Identity', 'classic_option']);
        });
    }
};
