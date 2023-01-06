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
        Schema::connection('mysql')->create('books', function (Blueprint $table) {
            $table->id();
            $table->string("judul",100);
            $table->string("kategori",100);
            $table->string("penulis",200);
            $table->string("penerbit", 200);
            $table->integer("tahun_terbit");
            $table->integer("jumlah_halaman");
            $table->string("ukuran_buku",50);
            $table->string("sinopsis",1000);
            $table->string("image_link",500);
            $table->boolean('status')->default(true);
            $table->string("id_peminjam",10)->nullable();
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
        Schema::dropIfExists('books');
    }
};
