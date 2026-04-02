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
use Filament\Schemas\Components\Group;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // Section 1 - Post Details
                Section::make("Post Details")
                    ->description("Fill in the details of the post")
                    ->icon('heroicon-o-document-text') // Ikon dokumen untuk detail teks
                    ->schema([
                        // Grouping fields into 2 columns
                        Group::make([
                            TextInput::make("title"),
                            TextInput::make("slug"),
                            Select::make("category_id")
                                ->relationship("category", "name")
                                ->preload()
                                ->searchable(),
                            ColorPicker::make("color"),
                        ])->columns(2),

                        MarkdownEditor::make("content"),
                    ])
                    ->columnSpan(2),

                // Grouping fields into 1 column for the sidebar
                Group::make([

                    // Section 2 - Image Upload
                    Section::make("Image Upload")
                        ->icon('heroicon-o-photo') // Ikon foto untuk unggah gambar
                        ->schema([
                            FileUpload::make("image")
                                ->disk("public")
                                ->directory("posts"),
                        ]),

                    // Section 3 - Meta Information
                    Section::make("Meta Information")
                        ->icon('heroicon-o-tag') // Ikon tag untuk informasi meta & kategori
                        ->schema([
                            TagsInput::make("tags"),
                            Checkbox::make("published"),
                            DateTimePicker::make("published_at"),
                        ]),

                ])->columnSpan(1),

            ])->columns(3);
    }
}