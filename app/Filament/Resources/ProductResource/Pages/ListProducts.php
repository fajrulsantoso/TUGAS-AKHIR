<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    // heading halaman utama

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Produk'), // Ubah label di sini,
        ];
    }
}
