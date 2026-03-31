<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;
use Filament\Schemas\Components\Group;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([

                // KIRI (2/3)
                Section::make("Post Details")
                    ->description("Fill in the details of the post")
                    ->icon('heroicon-o-document-text')
                    ->schema([

                        // 2 KOLOM UTAMA
                        Group::make([
                            TextInput::make('title')
                                ->required(),

                            TextInput::make('slug'),

                            Select::make('category_id')
                                ->relationship('category', 'name')
                                ->searchable(),

                            ColorPicker::make('color'),
                        ])->columns(2),

                        // FULL WIDTH
                        MarkdownEditor::make('body')
                            ->columnSpanFull(),

                        MarkdownEditor::make('content')
                            ->columnSpanFull(),
                    ])
                    ->columnSpan(2),

                // KANAN (1/3)
                Group::make([

                    Section::make('Image Upload')
                        ->icon('heroicon-o-photo')
                        ->schema([
                            FileUpload::make('image')
                                ->disk('public')
                                ->directory('post'),
                        ]),

                    Section::make('Meta')
                        ->icon('heroicon-o-cog-6-tooth')
                        ->schema([
                            TagsInput::make('tags'),
                            Checkbox::make('published'),
                            DateTimePicker::make('published_at'),
                        ]),

                ])
                ->columnSpan(1),

            ]);
    }
}