<?php

namespace App\Filament\Resources\TabelPembeliResource\Pages;

use App\Filament\Resources\TabelPembeliResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTabelPembelis extends ListRecords
{
    protected static string $resource = TabelPembeliResource::class;
    protected ?string $heading = 'Data Pembeli';




    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Pembeli'), // Ubah label di sini,

            
        ];
    }
}
