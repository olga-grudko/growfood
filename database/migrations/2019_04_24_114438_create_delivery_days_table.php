<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_days', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tarif_id')->unsigned();
            $table->integer('day');
        });

        Schema::table('delivery_days', function($table)
        {
            $table->foreign('tarif_id')->references('id')->on('tarifs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_days');
    }
}
