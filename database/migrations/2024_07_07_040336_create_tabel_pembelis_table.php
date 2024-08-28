<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tabel_pembelis', function (Blueprint $table) {
            $table->id();
            // $table->bigInteger('idpembeli')->unsigned()->unique();  // Pastikan kolom ini unik jika ingin menjadi identifier yang unik
            $table->string('namapembeli');
            $table->string('alamatpembeli');
            $table->integer('nohppembeli');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabel_pembelis');
    }
};
