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
        Schema::create('formulirs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->string('nama');
            $table->string('alamat');
            $table->string('telp');
            $table->string('email');
            $table->date('tanggal_sewa');
            $table->unsignedBigInteger('mobil_sewa');
            $table->foreign('mobil_sewa')->references('id')->on('kendaraans');
            $table->datetime('pickup_time');
            $table->integer('harga');
            $table->string('order_code');
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
        Schema::dropIfExists('formulirs');
    }
};
