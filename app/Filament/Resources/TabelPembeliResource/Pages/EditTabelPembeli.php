<?php

namespace App\Filament\Resources\TabelPembeliResource\Pages;

use App\Filament\Resources\TabelPembeliResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTabelPembeli extends EditRecord
{
    protected static string $resource = TabelPembeliResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
