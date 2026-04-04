<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Checkbox;
use Filament\Actions\Action;
use Filament\Tables\Columns\IconColumn;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([

                    Step::make('Product Info')
                        ->icon('heroicon-o-information-circle')
                        ->description('Isi Informasi Produk')
                        ->schema([
                            Group::make([
                                TextInput::make('name')
                                    ->required()
                                    ->minLength(3)
                                    ->maxLength(255),

                                TextInput::make('sku')
                                    ->required()
                                    ->unique(ignoreRecord: true),
                            ])->columns(2),

                            MarkdownEditor::make('description'),
                        ]),

                    Step::make('Product Price and Stock')
                        ->icon('heroicon-o-currency-dollar')
                        ->description('Isi Harga Produk')
                        ->schema([
                            Group::make([
                                TextInput::make('price')
                                    ->numeric()
                                    ->required()
                                    ->gt(0), // wajib lebih dari 0

                                TextInput::make('stock')
                                    ->numeric()
                                    ->required()
                                    ->minValue(0),
                            ])->columns(2),

                            MarkdownEditor::make('description'),
                        ]),

                    Step::make('Media and status')
                        ->icon('heroicon-o-photo')
                        ->description('Isi Gambar Produk')
                        ->schema([
                            FileUpload::make('image')
                                ->image()
                                ->maxSize(2048)
                                ->disk('public')
                                ->directory('products'),

                            Checkbox::make('is_active'),

                            Checkbox::make('is_featured'),
                        ]),
                    
                ])
                ->columnSpanFull()
                ->submitAction(
                    Action::make('save')
                        ->label('Save Product')
                        ->button()
                        ->color('primary')
                        ->submit('save')
                )
                
            ]);
    }
}