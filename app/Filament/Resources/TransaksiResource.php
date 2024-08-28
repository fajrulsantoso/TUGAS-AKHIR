<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Form;
use App\Models\Transaksi;
use Filament\Tables\Table;
use App\Models\TabelPembeli;
//use App\Models\Detailtransaksi;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use App\Filament\Resources\TransaksiResource\Pages;


class TransaksiResource extends Resource
{
    protected static ?string $model = Transaksi::class;
    protected static ?string $navigationLabel = 'Data Transaksi'; // Ubah label navigasi menjadi 'Barang'
    

    public static function form(Form $form): Form
    {
        $Produk = Product::get();
        return $form
        ->schema([
            Forms\Components\Group::make()
            ->schema([
                Forms\Components\Card::make()
                ->schema([
                    Forms\Components\TextInput::make('invoice_number')
                    ->default('ABC-'.random_int(100000,999999))
                    ->required(),
                    Forms\Components\Datepicker::make('invoice_date')
                    ->default(now())
                    ->required(),
                    Forms\Components\Select::make('id_pembeli')
                    ->label('Pembeli')
                    ->options(TabelPembeli::query()->pluck('namapembeli','id'))
                    ->required()                        
                    ->reactive()
                    
                    
                ])->columns(['sm'=>2,
            ]),
                Forms\Components\Card::make()
                ->schema([
                    Forms\Components\Placeholder::make('Product')
                    ->label('Produk'),
                    Forms\Components\Repeater::make('detailtransaksis')
                    ->label('DataTransaksi')

                    ->relationship()
                    ->schema([
                        Forms\Components\Select::make('id_produk')
                        ->label('Produk')
                        ->options(
                            Product::query()->pluck('NamaProduk','id')                                
                            )
                            
                                //biar tidak ada barang yang dipilih dobel
                                ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                ->reactive()
                                ->afterStateUpdated(function($state, callable $set){
                                    $Product=Product::find($state);
                                    if($Product){
                                        $set('harga_jual', $Product->HargaProduk);
                                        $set('harga_penjualan', $Product->HargaProduk);
                                        $set('StockProduk', $Product->StockProduk);

                                    }
                                })
                                ->required()
                                ->columnSpan(['md'=>5,]),

                                Forms\Components\TextInput::make('jumlah_barang')                                                               
                                ->numeric()
                                ->default(1)
                                ->columnSpan([
                                    'md'=>2,
                                    ])
                                ->required(),
                                Forms\Components\Hidden::make('harga_jual')
                                ->default(1),
                                Forms\Components\TextInput::make('harga_penjualan')
                                ->disabled()
                                ->dehydrated(false)
                                ->numeric()
                                ->columnSpan([
                                    'md'=>3,
                                ]),
                                Forms\Components\TextInput::make('StockProduk')
                                ->disabled()
                                ->numeric()
                                ->dehydrated(false)//
                                ->columnSpan([
                                    'md'=>3,
                                ]),

                    ])
                    ->mutateRelationshipDataBeforeCreateUsing(function (array $data): array {
                       
                        $kurangStok=Product::find($data['id_produk']);
                        $updateStok=$kurangStok['StockProduk']-$data['jumlah_barang'];
                        $kurangStok->StockProduk=$updateStok;
                        $kurangStok->save();
                        //dd($kurangStok);
                 
                        return $data;
                    })
                    ->live()                    
                    ->afterStateUpdated(function (Forms\Get $get, Forms\Set $set){
                        self::updateTotals($get, $set);
                        
                    })

                    //Merubah tambah produk
                    ->addActionLabel('Tambah Produk')

                    // // After deleting a row, we need to update the totals
                    // ->deleteAction(function (Forms\Get $get, Forms\Set $set, $state){
                    //     self::updateTotals($get, $set);
                    //     dd($state); // Sekarang $state didefinisikan
                    // })
                    
                    // ->reorderable(false)
                    // ->columns(2)
                ]),
                Section::make()
                ->columns(1)
                ->maxWidth('1/2')
                ->schema([
                    Forms\Components\TextInput::make('subtotal')
                        ->numeric()
                        // Read-only, because it's calculated
                        ->readOnly()
                        ->prefix('$')
                        // This enables us to display the subtotal on the edit page load
                        /*->afterStateHydrated(function (Forms\Get $get, Forms\Set $set) {
                            //ray("Welll.... Seeing this value changed");
                            
                            self::updateTotals($get, $set);
                        })*/,
                        Forms\Components\TextInput::make('total_harga')
                        ->numeric()
                        // Read-only, because it's calculated
                        ->readOnly()
                        ->prefix('$')
                ])
            ])->columnSpan(span:'full')
                    
        ]);
            
    }
    public static function updateTotals(Forms\Get $get, Forms\Set $set): void
{
    $selectedProducts = collect($get('detailtransaksis'))->filter(fn($item) => !empty($item['id_produk']) && !empty($item['jumlah_barang']));
        $prices = Product::find($selectedProducts->pluck('id_produk'))->pluck('HargaProduk', 'id');
    $subtotal = $selectedProducts->reduce(function ($subtotal, $produk) use ($prices) {
        return $subtotal + ($prices[$produk['id_produk']] * $produk['jumlah_barang']);
    }, 0);
    $set('subtotal', number_format($subtotal, 2, '.', ''));
    $set('total_harga', number_format( ($subtotal), 2, '.', ''));
}
    
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at'),
                Tables\Columns\TextColumn::make('pembeli.namapembeli') ,
                Tables\Columns\TextColumn::make('total_harga')->money('idr'),
                Tables\Columns\CheckboxColumn::make('status')
                ->label('Selesai (tidak bisa diubah kembali)')
                ->getStateUsing(fn($record) => $record->status)
                ->action(fn($record) => $record->update(['status' => !$record->status]))
                ->disabled(fn($record) => $record->status == 1), 
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListTransaksis::route('/'),
            'create' => Pages\CreateTransaksi::route('/create'),
            'edit' => Pages\EditTransaksi::route('/{record}/edit'),
        ];
    }
}