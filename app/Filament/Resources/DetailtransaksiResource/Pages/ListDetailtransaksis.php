<?php

namespace App\Filament\Resources\DetailtransaksiResource\Pages;

use App\Filament\Resources\DetailtransaksiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDetailtransaksis extends ListRecords
{
    protected static string $resource = DetailtransaksiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
