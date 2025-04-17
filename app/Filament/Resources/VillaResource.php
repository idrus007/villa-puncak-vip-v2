<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VillaResource\Pages;
use App\Filament\Resources\VillaResource\RelationManagers;
use App\Models\Villa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VillaResource extends Resource
{
    protected static ?string $model = Villa::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('name')
                ->label('Nama Villa')
                ->maxLength(255)
                ->placeholder('Masukkan nama villa')
                ->required(),

                Forms\Components\TextInput::make('price')
                ->label('Harga')
                ->placeholder('Masukkan harga villa')
                ->prefix('Rp')
                ->numeric()
                ->required(),

                Forms\Components\Textarea::make('description')
                ->label('Deskripsi')
                ->placeholder('Masukkan deskripsi villa')
                ->rows(5)
                ->required(),

                Forms\Components\Textarea::make('address')
                ->label('Alamat')
                ->placeholder('Masukkan alamat villa')
                ->rows(5)
                ->required(),

                Forms\Components\Repeater::make('facilities')
                ->relationship()
                ->label('Fasilitas')
                ->schema([
                    Forms\Components\TextInput::make('name')
                    ->label('Nama Fasilitas')
                    ->placeholder('Masukkan nama fasilitas')
                    ->maxLength(255)
                    ->required(),
                ]),

                Forms\Components\Repeater::make('paymentMethods')
                ->relationship()
                ->label('Metode Pembayaran')
                ->schema([
                    Forms\Components\TextInput::make('bank_name')
                    ->label('Nama Bank')
                    ->placeholder('Masukkan nama bank')
                    ->maxLength(255)
                    ->required(),

                    Forms\Components\TextInput::make('account_number')
                    ->label('Nomor Rekening')
                    ->placeholder('Masukkan nomor rekening')
                    ->maxLength(255)
                    ->required(),
                ])
            ]);
    }

    public static function getNavigationBadge(): ?string
    {
        return Villa::count();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('name')
                ->label('Nama Villa')
                ->searchable()
                ->sortable(),
                Tables\Columns\TextColumn::make('price')
                ->label('Harga')
                ->sortable()
                ->money('idr', true)
                ->searchable(),

                Tables\Columns\TextColumn::make('facilities_count')
                ->label('Jumlah Fasilitas')
                ->counts('facilities'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
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
            'index' => Pages\ListVillas::route('/'),
            'create' => Pages\CreateVilla::route('/create'),
            'edit' => Pages\EditVilla::route('/{record}/edit'),
        ];
    }
}
