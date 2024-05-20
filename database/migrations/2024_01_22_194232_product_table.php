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
   
        Schema::create('products', function (Blueprint $table) {
            $table->id('id_barang');
            $table->string('kode_barang', 20);
            $table->string('nama_barang', 50);
            $table->integer('jumlah_barang');
            $table->string('satuan_barang', 20);
            $table->double('harga_beli', 20, 2);
            $table->boolean('status_barang');
            $table->unsignedBigInteger('user_id')->comment('Created By User');

            $table->foreign('user_id')->references('id')->on('users');
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
        // Schema::dropIfExists('products');
    }
};
