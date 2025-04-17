<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingTransactionResource\Pages;
use App\Filament\Resources\BookingTransactionResource\RelationManagers;
use App\Models\BookingTransaction;
use App\Models\Villa;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingTransactionResource extends Resource
{
    protected static ?string $model = BookingTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\Wizard::make([
                Forms\Components\Wizard\Step::make('Identitas Customer')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('customer_name')
                            ->label('Nama Lengkap')
                            ->maxLength(255)
                            ->placeholder('Masukkan nama lengkap')
                            ->required(),

                        Forms\Components\TextInput::make('customer_email')
                            ->label('Email')
                            ->maxLength(255)
                            ->placeholder('Masukkan email')
                            ->email()
                            ->required(),
                        
                        Forms\Components\TextInput::make('customer_phone')
                            ->label('No. Whatsapp')
                            ->maxLength(255)
                            ->placeholder('Masukkan no. whatsapp')
                            ->tel()
                            ->required(),
                        
                        Forms\Components\TextInput::make('identity_number')
                            ->label('No. KTP')
                            ->maxLength(255)
                            ->placeholder('Masukkan no. KTP')
                            ->required(),

                        Forms\Components\Textarea::make('customer_address')
                            ->label('Alamat')
                            ->rows(5)
                            ->columnSpanFull()
                            ->placeholder('Masukkan alamat')
                            ->required(),
                    ]),

                Forms\Components\Wizard\Step::make('Data Booking')
                    ->columns(2)
                    ->schema([
                            Forms\Components\Select::make('villa_id')
                                ->relationship('villa', 'name')
                                ->required()
                                ->reactive()
                                ->label('Nama Villa')
                                ->afterStateUpdated(fn (Set $set) => $set('total_price', null)),

                            Forms\Components\TextInput::make('booking_code')
                                ->label('Booking Code')
                                ->disabled()
                                ->dehydrated()
                                ->default(fn () => 'Auto Generated'),

                            Forms\Components\DateTimePicker::make('check_in_date')
                                ->label('Check In Date')
                                ->required()
                                ->reactive(),

                            Forms\Components\DateTimePicker::make('check_out_date')
                                ->label('Check Out Date')
                                ->required()
                                ->reactive()
                                ->afterStateUpdated(function (Get $get, Set $set) {
                                    $checkIn = $get('check_in_date');
                                    $checkOut = $get('check_out_date');
                                    $villaId = $get('villa_id');

                                    if ($checkIn && $checkOut && $villaId) {
                                        $start = \Carbon\Carbon::parse($checkIn);
                                        $end = \Carbon\Carbon::parse($checkOut);

                                        if ($start->lessThan($end)) {
                                            $duration = (int) $start->diffInDays($end); 
                                            $set('duration', $duration);

                                            $villa = Villa::find($villaId);

                                            if ($villa && $villa->price) {
                                                $villaPrice = (int) $villa->price;

                                                if ($villaPrice <= 0 || $duration <= 0) {
                                                    $set('total_price', 0);
                                                } else {
                                                    $totalPrice = floor($villaPrice * $duration); 
                                                    $set('total_price', $totalPrice);
                                                }
                                            } else {
                                                $set('total_price', 0);
                                            }
                                        } else {
                                            $set('duration', 1);
                                            $set('total_price', 0);
                                        }
                                    }
                                }),

                            Forms\Components\TextInput::make('duration')
                                ->label('Duration (days)')
                                ->disabled()
                                ->numeric()
                                ->integer()
                                ->dehydrated(),

                            Forms\Components\TextInput::make('total_price')
                                ->label('Total Price')
                                ->prefix('Rp ')
                                ->disabled()
                                ->numeric()
                                ->dehydrated(true),
                    ]),     

                Forms\Components\Wizard\Step::make('Pembayaran')
                    ->columns(2)
                    ->schema([
                        Forms\Components\Select::make('payment_method_id')
                            ->options(function (Get $get) {
                                $villaId = $get('villa_id');
                                if (!$villaId) {
                                    return [];
                                }

                                return \App\Models\PaymentMethod::where('villa_id', $villaId)
                                    ->get()
                                    ->mapWithKeys(function ($payment_method) {
                                        return [
                                            $payment_method->id => $payment_method->name
                                                . ' ' . $payment_method->bank_name
                                                . ' - ' . $payment_method->account_number,
                                        ];
                                    })
                                    ->toArray();
                            })
                            ->label('Metode Pembayaran')
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->placeholder('Pilih Metode Pembayaran'),

                        Forms\Components\TextInput::make('total_price')
                            ->label('Total Harga')
                            ->prefix('Rp ')
                            ->disabled()
                            ->numeric()
                            ->dehydrated(true),

                        Forms\Components\Select::make('status_bayar')
                            ->label('Pilih Pembayaran')
                            ->options([
                                'dp' => 'DP',
                                'full' => 'Full',
                            ])
                            ->reactive()
                            ->afterStateUpdated(function (Get $get, Set $set) {
                                if ($get('status_bayar') === 'dp') {
                                    $remainingAmount = (int) max($get('total_price') - $get('paid_amount'), 0);
                                    $set('remaining_amount', $remainingAmount);
                                } else {
                                    $set('remaining_amount', 0);
                                }
                            }),

                        Forms\Components\TextInput::make('paid_amount')
                            ->label('Masukkan Jumlah Pembayaran')
                            ->placeholder('Masukkan jumlah pembayaran')
                            ->prefix('Rp ')
                            ->numeric()
                            ->reactive()
                            ->integer()
                            ->debounce(500)
                            ->visible(fn (Get $get) => $get('status_bayar') === 'dp') 
                            ->afterStateUpdated(function (Get $get, Set $set) {
                                if ($get('status_bayar') === 'dp') {
                                    $remainingAmount = (int) max($get('total_price') -(int) $get('paid_amount'), 0);
                                    $set('remaining_amount', $remainingAmount);
                                } else {
                                    $set('remaining_amount', 0);
                                }
                            }),

                        Forms\Components\TextInput::make('remaining_amount')
                            ->label('Sisa Pembayaran')
                            ->prefix('Rp ')
                            ->disabled()
                            ->numeric()
                            ->default(0)
                            ->visible(fn (Get $get) => $get('status_bayar') === 'dp') 
                            ->dehydrated(false),

                        Forms\Components\Toggle::make('is_paid')
                            ->label('Sudah Bayar?')
                            ->default(false)  
                            ->reactive()  
                            ->onIcon('heroicon-s-check-circle')  
                            ->offIcon('heroicon-s-x-circle') 
                            ->onColor('success') 
                            ->offColor('danger'),

                        Forms\Components\FileUpload::make('payment_proof')
                            ->label('Bukti Pembayaran')
                            ->image()
                            ->disk('public')
                            ->directory('bukti-pembayaran')
                            ->preserveFilenames()
                            ->required(),

                        Forms\Components\Select::make('status')
                            ->options([
                                'available' => 'Available',
                                'booked' => 'Booked',
                            ])
                            ->disabled()
                            ->default('booked'),
                    ]),
            ])->columnSpanFull()
        ]);
}

    public static function getNavigationBadge(): ?string
    {
        return BookingTransaction::count();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('booking_code')
                    ->label('Booking Code')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('check_in_date')
                    ->label('Check In')
                    ->date(),

                    Tables\Columns\TextColumn::make('check_out_date')
                    ->label('Check Out')
                    ->date(),

                Tables\Columns\TextColumn::make('duration')
                    ->label('Duration'),

                Tables\Columns\TextColumn::make('total_price')
                    ->label('Total Price'),

                Tables\Columns\BadgeColumn::make('is_paid')
                ->label('Status Bayar')
                ->getStateUsing(fn ($record) => $record->is_paid ? 'Sudah Bayar' : 'Belum Bayar')  
                ->colors([
                    'success' => fn ($record) => $record->is_paid, 
                    'danger' => fn ($record) => !$record->is_paid, 
                ]),  
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\Action::make('approve')
                    ->label('Setujui Pembayaran')
                    ->color('success')
                    ->icon('heroicon-o-check-circle')
                    ->action(function (BookingTransaction $record) {
                        $record->update([
                            'is_paid' => 'true',
                        ]);
                    })
                    ->requiresConfirmation()
                    ->visible(fn (BookingTransaction $record) => $record->is_paid === false),
                ]),
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
            'index' => Pages\ListBookingTransactions::route('/'),
            'create' => Pages\CreateBookingTransaction::route('/create'),
            'edit' => Pages\EditBookingTransaction::route('/{record}/edit'),
        ];
    }
}
