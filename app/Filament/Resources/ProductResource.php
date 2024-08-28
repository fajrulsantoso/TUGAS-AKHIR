<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationLabel = 'Katalog Produk'; // Ubah label navigasi menjadi 'Barang'

    public static function form(Form $form): Form
    {
        // bagian dalam
        return $form
            ->schema([
                TextInput::make('NamaProduk')->required(),
                FileUpload::make('GambarProduk')->required(),
                TextInput::make('HargaProduk')->required(),
                TextInput::make('StockProduk')->required(),
                Textarea::make('DeskripsiProduk'),
            ]);
    }

    public static function table(Table $table): Table
    {
        // bagian Diluar
        return $table
            ->columns(  [
                TextColumn::make('NamaProduk')->sortable()->searchable(),
                ImageColumn::make('GambarProduk')->sortable(),
                TextColumn::make('HargaProduk')->label('HargaProduk'),
                TextColumn::make('StockProduk')->limit(50),
                TextColumn::make('DeskripsiProduk')->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
