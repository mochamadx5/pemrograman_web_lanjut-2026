<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;

use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;

use Filament\Tables\Table;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\ReplicateAction;
use Filament\Tables\Actions\Action; // Untuk custom action
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;

use Filament\Tables;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;

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
                            Forms\Components\Select::make('category_id')
                                ->relationship('category', 'name')
                                ->searchable()
                                ->required(),
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
                            // Input Tags Many-to-Many
                            Forms\Components\Select::make('tags')
                                ->relationship('tags', 'name')
                                ->multiple()
                                ->preload()
                                ->searchable(),
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
                // Latihan Praktikum: Tambahkan kolom ID dan sembunyikan secara default
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->toggleable(), // Latihan Praktikum: Aktifkan toggle

                TextColumn::make('slug')
                    ->searchable()
                    ->sortable()
                    ->toggleable(), // Latihan Praktikum: Aktifkan toggle

                TextColumn::make('category.name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(), // Latihan Praktikum: Aktifkan toggle

                ColorColumn::make('color')
                    ->toggleable(), // Latihan Praktikum: Aktifkan toggle

                ImageColumn::make('image')
                    ->disk('public')
                    ->toggleable(), // Latihan Praktikum: Aktifkan toggle
                
                // Latihan Praktikum: Tambahkan kolom Tags (Array/Teks) dan sembunyikan secara default
                TextColumn::make('tags')
                    ->label('Tags')
                    ->toggleable(isToggledHiddenByDefault: true),

                // Latihan Praktikum: Tambahkan IconColumn untuk Published
                IconColumn::make('published')
                    ->boolean()
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(), //Aktifkan toggle
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                // Latihan Praktikum: Buat filter tanggal
                Filter::make('created_at')
                    ->label('Creation Date')
                    ->form([
                        DatePicker::make('created_at')
                            ->label('Select Date:'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query->when(
                            $data['created_at'],
                            fn (Builder $query, $date) => $query->whereDate('created_at', $date)
                        );
                    }),
                
                // Latihan Praktikum: Buat filter kategori menggunakan SelectFilter
                SelectFilter::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                
                // Latihan Praktikum: Tambahkan DeleteAction
                DeleteAction::make(), 
                
                // Latihan Praktikum: Tambahkan ReplicateAction (beserta icon)
                ReplicateAction::make()
                    ->icon('heroicon-o-document-duplicate'),

                // Latihan Praktikum: Buat Custom Action Status (dengan icon dan confirmation)
                Action::make('status')
                    ->label('Status Change')
                    ->icon('heroicon-o-check-circle')
                    ->requiresConfirmation() 
                    ->form([ // <-- INI YANG DIUBAH (dari schema menjadi form)
                        Checkbox::make('published')
                            ->default(fn ($record): bool => (bool) $record->published),
                    ])
                    ->action(function ($record, array $data) {
                        $record->update(['published' => $data['published']]);
                    }),
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
