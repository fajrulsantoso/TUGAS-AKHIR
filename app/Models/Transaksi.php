<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\TabelPembeli;
use App\Models\Detailtransaksi;

class Transaksi extends Model
{
    use HasFactory;
    
    protected $fillable = ['id_pembeli', 'total_harga', 'invoice_date', 'invoice_number'];
    protected $guarded = ['id', 'created_at', 'updated_at']; // Perbaiki penulisan 'updated_at'

    public function pembeli(): BelongsTo
    {
        return $this->belongsTo(TabelPembeli::class,'id_pembeli');
    }

    public function detailtransaksis(): HasMany
    {
        return $this->hasMany(Detailtransaksi::class); // Pastikan nama metode sama
    }

    public function getStatusLabelAttribute()
    {
        return $this->status ? 'Selesai' : 'Belum Selesai';
    }
}
