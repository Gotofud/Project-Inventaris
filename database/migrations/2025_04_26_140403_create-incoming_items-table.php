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
        Schema::create('incoming_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('icm_code');
            $table->integer('amount');
            $table->date('entry_date');
            $table->string('info');
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('id')->on('maindatas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incoming_goods');
    }
};
