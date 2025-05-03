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
        Schema::create('returnDatas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('return_code');
            $table->integer('amount');
            $table->date('return_date');
            $table->string('brws_name');
            $table->string('brws_id');
            $table->string('status');
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
        Schema::dropIfExists('returnDatas');
    }
};
