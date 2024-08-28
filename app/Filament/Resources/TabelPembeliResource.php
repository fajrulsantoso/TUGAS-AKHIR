<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\TabelPembeli;
use Filament\Resources\Resource;
use App\Filament\Pages\StrukView;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TabelPembeliResource\Pages;
use App\Filament\Resources\TabelPembeliResource\RelationManagers;
use Filament\Forms\Components\Card;
class TabelPembeliResource extends Resource
{
    protected static ?string $model = TabelPembeli::class;

    protected static ?string $navigationLabel = 'Data Pembeli'; // Ubah label navigasi menjadi 'Barang'


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Card::make()
                ->schema([
                     TextInput::make('id')->disabled(),
                    TextInput::make('namapembeli')->required(),
                    TextInput::make('alamatpembeli')->required(),
                    TextInput::make('nohppembeli')->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('id'),
                TextColumn::make('namapembeli')->sortable()->searchable(),
                TextColumn::make('alamatpembeli'),
                TextColumn::make('nohppembeli'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTabelPembelis::route('/'),
            'create' => Pages\CreateTabelPembeli::route('/create'),
            'edit' => Pages\EditTabelPembeli::route('/{record}/edit'),
        ];
    }    
}
