<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Transaksi;
use App\Filament\Resources\ProductResource\RelationManagers;


class Detailtransaksi extends Model
{
    use HasFactory;
    
    //protected $fillable = ['id_transaksi', 'id_barang', 'harga_jual', 'jumlah_barang', 'subtotal'];
    protected $guarded = [];

    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
