<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupplierResource\Pages;
use App\Models\Supplier;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SupplierResource extends Resource
{
    protected static ?string $model = Supplier::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationLabel = 'Data Supplier';
    protected static ?string $pluralLabel = 'Supplier';
    protected static ?string $navigationGroup = 'Manajemen Data';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')->required(),
                Forms\Components\TextInput::make('alamat')->required(),
                Forms\Components\TextInput::make('telepon')->required(),
                Forms\Components\TextInput::make('email')->email()->required(),
                Forms\Components\TextInput::make('perusahaan')->required(),
                Forms\Components\TextInput::make('jenis_barang')->required(),

                Forms\Components\TextInput::make('harga_barang')
                    ->numeric()
                    ->required()
                    ->label('Harga Barang')
                    ->live(debounce: 500),

                Forms\Components\TextInput::make('jumlah_barang')
                    ->numeric()
                    ->required()
                    ->label('Jumlah Barang')
                    ->live(debounce: 500),

                Forms\Components\TextInput::make('total_harga')
                    ->numeric()
                    ->label('Total Harga')
                    ->disabled()
                    ->dehydrated()
                    ->default(0)
                    ->reactive()
                    ->afterStateHydrated(function ($set, $state, $get) {
                        $set('total_harga', ($get('harga_barang') ?? 0) * ($get('jumlah_barang') ?? 0));
                    })
                    ->afterStateUpdated(function ($set, $state, $get) {
                        $set('total_harga', ($get('harga_barang') ?? 0) * ($get('jumlah_barang') ?? 0));
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')->searchable(),
                Tables\Columns\TextColumn::make('alamat'),
                Tables\Columns\TextColumn::make('telepon'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('perusahaan'),
                Tables\Columns\TextColumn::make('jenis_barang'),
                Tables\Columns\TextColumn::make('harga_barang')->money('IDR', true),
                Tables\Columns\TextColumn::make('jumlah_barang'),
                Tables\Columns\TextColumn::make('total_harga')->money('IDR', true),
                Tables\Columns\TextColumn::make('created_at')->label('Tanggal Input')->dateTime('d M Y H:i'),
            ])
            ->filters([])

            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])

            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSuppliers::route('/'),
            'create' => Pages\CreateSupplier::route('/create'),
            'edit' => Pages\EditSupplier::route('/{record}/edit'),
        ];
    }
}