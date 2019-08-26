<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_peminjam');
            $table->string('phone');
            $table->integer('jumlah_barang');
            $table->integer('lama_pinjam')->nullable();
            $table->integer('harga');
            $table->integer('ppn');
            $table->integer('total_bayar');
            $table->date('tanggal_kembali')->nullable();
            $table->integer('created_by')->unsigned();
            $table->string('updated_by')->nullable();
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barangs');
    }
}
