<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key dengan auto_increment
            $table->string('NamaProduk', 255);
            $table->string('GambarProduk', 255);
            $table->decimal('HargaProduk');
            $table->unsignedInteger('StockProduk');
            $table->text('DeskripsiProduk')->nullable();
            $table->timestamps();
            
            // Tidak perlu menambahkan primary key atau auto_increment lagi untuk kolom lain
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}