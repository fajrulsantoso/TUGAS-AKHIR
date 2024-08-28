<?php

namespace App\Filament\Resources\TabelPembeliResource\Pages;

use App\Filament\Resources\TabelPembeliResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTabelPembeli extends CreateRecord
{
    protected static string $resource = TabelPembeliResource::class;
    protected ?string $heading = 'Data Pembeli';

}
