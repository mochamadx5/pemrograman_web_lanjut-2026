<?php

namespace App\Filament\Resources;

use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Kolom Kiri (Lebih lebar, porsi 2/3)
                Group::make([
                    Section::make('Post Details')
                        ->description('Isi detail utama dari postingan ini')
                        ->icon('heroicon-o-document-text')
                        ->schema([
                            TextInput::make('title')
                                ->required()
                                ->minLength(5) // Tugas Praktikum 6: Minimal 5 karakter
                                ->maxLength(255),
                            TextInput::make('slug')
                                ->required()
                                ->minLength(3) // Tugas Praktikum 6: Minimal 3 karakter
                                ->maxLength(255)
                                ->unique(ignoreRecord: true)
                                ->validationMessages([
                                    'unique' => 'Slug ini sudah dipakai, coba variasi lain.', // Custom Message
                                ]),
                            Select::make('category_id')
                                ->relationship('category', 'name')
                                ->preload()
                                ->searchable()
                                ->required() // Tugas Praktikum 6: Wajib pilih kategori
                                ->validationMessages([
                                    'required' => 'Kategori wajib dipilih ya!', // Custom Message
                                ]),
                            ColorPicker::make('color'),
                            MarkdownEditor::make('body')
                                ->columnSpanFull(),
                        ])->columns(2), // Elemen di dalam section ini dibagi 2 kolom
                ])->columnSpan(2),

                // Kolom Kanan (Lebih sempit, porsi 1/3)
                Group::make([
                    Section::make('Image Upload')
                        ->schema([
                            FileUpload::make('image')
                                ->disk('public')
                                ->directory('posts')
                                ->required(), // Tugas Praktikum 6: Gambar wajib diupload
                        ]),
                    Section::make('Meta Information')
                        ->schema([
                            TagsInput::make('tags'),
                            Checkbox::make('published'),
                            DateTimePicker::make('published_at'),
                        ]),
                ])->columnSpan(1),

            ])->columns(3); // Total grid halaman dibagi 3 kolom
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(), // Tugas Praktikum: Aktifkan sortable
                TextColumn::make('slug')
                    ->searchable()
                    ->sortable(), // Tugas Praktikum: Aktifkan sortable
                TextColumn::make('category.name') 
                    ->searchable()
                    ->sortable(), // Tugas Praktikum: Aktifkan sortable pada relasi
                ColorColumn::make('color'),
                ImageColumn::make('image')
                    ->disk('public'),
                IconColumn::make('published') 
                    ->boolean(),
                TextColumn::make('created_at') // Tambahan kolom untuk fitur sorting tanggal
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc') // Tugas Praktikum: Default sorting descending berdasarkan tanggal
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(), 
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
