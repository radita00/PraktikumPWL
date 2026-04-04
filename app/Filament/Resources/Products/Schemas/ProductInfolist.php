<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;

use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Product Tabs')
            ->tabs([
                Tab::make('Product Info')
                    ->icon('heroicon-o-information-circle') // CHANGE: icon tab
                    ->schema([
                        TextEntry::make('name')
                            ->label('Product Name')
                            ->weight('bold')
                            ->color('primary'),

                        TextEntry::make('id')
                            ->label('Product ID'),

                        TextEntry::make('sku')
                            ->label('SKU')
                            ->badge()
                            ->color('success'),

                        TextEntry::make('description')
                            ->label('Description'),

                        TextEntry::make('created_at')
                            ->label('Created At')
                            ->date('d M Y')
                            ->color('info'),
                    ]),

                Tab::make('Price & Stock')
                    ->icon('heroicon-o-currency-dollar') // CHANGE: icon tab
                    ->schema([
                        TextEntry::make('price')
                            ->label('Product Price')
                            ->weight('bold')
                            ->color('primary')
                            ->icon('heroicon-s-currency-dollar')
                            ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')),

                        TextEntry::make('stock')
                            ->label('Product Stock')
                            ->badge() // CHANGE: jadikan badge
                            ->formatStateUsing(fn ($state) => $state . ' pcs') // CHANGE: tampilkan jumlah
                            ->color(fn ($state) => match (true) { // CHANGE: warna dinamis
                                $state == 0 => 'danger',
                                $state <= 10 => 'warning',
                                default => 'success',
                            }),
                    ]),

                Tab::make('Image & Status')
                    ->icon('heroicon-o-photo') // CHANGE: icon tab
                    ->schema([
                        ImageEntry::make('image')
                            ->label('Product Image')
                            ->disk('public'),

                        TextEntry::make('price')
                            ->label('Product Price')
                            ->weight('bold')
                            ->color('primary')
                            ->icon('heroicon-s-currency-dollar')
                            ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')),

                        TextEntry::make('stock')
                            ->label('Product Stock')
                            ->badge() // CHANGE: badge
                            ->color(fn ($state) => match (true) { // CHANGE: warna dinamis
                                $state == 0 => 'danger',
                                $state <= 10 => 'warning',
                                default => 'success',
                            }),

                        IconEntry::make('is_active')
                            ->label('Is Active?')
                            ->boolean(),

                        IconEntry::make('is_featured')
                            ->label('Is Featured?')
                            ->boolean(),
                    ]),
            ])
            ->columnSpanFull()
            ->vertical(), // CHANGE: tabs jadi vertical
                Section::make('Product Info')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Product Name')
                            ->weight('bold')
                            ->color('primary'),

                        TextEntry::make('id')
                            ->label('Product ID'),

                        TextEntry::make('sku')
                            ->label('Product SKU')
                            ->badge()
                            ->color('warning'), // CHANGE: warna badge diubah

                        TextEntry::make('description')
                            ->label('Product Description'),

                        TextEntry::make('created_at')
                            ->label('Product Creation Date')
                            ->date('d M Y')
                            ->color('info'),
                    ])
                    ->columnSpanFull(),

                Section::make('Pricing & Stock')
                    ->schema([
                        TextEntry::make('price')
                            ->label('Product Price')
                            ->icon('heroicon-o-currency-dollar')
                            ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')), // CHANGE: format rupiah

                        TextEntry::make('stock')
                            ->label('Product Stock')
                            ->icon('heroicon-o-cube'), // CHANGE: tambah icon stock
                    ])
                    ->columnSpanFull(),

                Section::make('Image and Status')
                    ->schema([
                        ImageEntry::make('image')
                            ->label('Product Image')
                            ->disk('public'),

                        TextEntry::make('price')
                            ->label('Product Price')
                            ->weight('bold')
                            ->color('primary')
                            ->icon('heroicon-s-currency-dollar')
                            ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')), // CHANGE: format rupiah

                        TextEntry::make('stock')
                            ->label('Product Stock')
                            ->weight('bold')
                            ->color('primary')
                            ->icon('heroicon-o-cube'), // CHANGE: tambah icon stock

                        IconEntry::make('is_active')
                            ->label('Is Active')
                            ->boolean(),

                        IconEntry::make('is_featured')
                            ->label('Is Featured')
                            ->boolean(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}