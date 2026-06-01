<?php

namespace App\Filament\Resources;

use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Actions\Action; // Untuk tombol Save

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section as InfolistSection;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\Tabs;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    // Step 1: Product Info
                    Step::make('Product Info')
                        ->description('Isi informasi dasar produk')
                        ->icon('heroicon-o-information-circle') // Tugas Praktikum: Tambah Icon
                        ->schema([
                            Group::make([
                                TextInput::make('name')->required(),
                                TextInput::make('sku')->required(),
                            ])->columns(2),
                            MarkdownEditor::make('description')
                                ->columnSpanFull(),
                        ]),
                    
                    // Step 2: Pricing & Stock
                    Step::make('Pricing & Stock')
                        ->description('Isi harga dan jumlah stok')
                        ->icon('heroicon-o-currency-dollar') // Tugas Praktikum: Tambah Icon
                        ->schema([
                            TextInput::make('price')
                                ->numeric()
                                ->gt(0) // Tugas Praktikum: Validasi harga > 0 (greater than zero)
                                ->required(),
                            TextInput::make('stock')
                                ->numeric()
                                ->required(),
                        ]),
                    
                    // Step 3: Media & Status
                    Step::make('Media & Status')
                        ->description('Upload gambar dan atur status')
                        ->icon('heroicon-o-photo') // Tugas Praktikum: Tambah Icon
                        ->schema([
                            FileUpload::make('image')
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
                        ->color('primary')
                        ->submit('save')
                )
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Tabs::make('Product Tabs')
                    // ->vertical()
                    ->tabs([
                        // Tab 1: Product Info
                        Tabs\Tab::make('Product Info')
                            ->icon('heroicon-o-information-circle') // Tugas Praktikum: Icon spesifik
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
                                    ->color('success'),
                                TextEntry::make('description')
                                    ->label('Product Description')
                                    ->columnSpanFull(),
                                TextEntry::make('created_at')
                                    ->label('Product Creation Date')
                                    ->date('d M Y')
                                    ->color('info'),
                            ])->columns(2),

                        // Tab 2: Pricing & Stock
                        Tabs\Tab::make('Pricing & Stock')
                            ->icon('heroicon-o-currency-dollar') // Tugas Praktikum: Icon spesifik
                            ->badge(fn ($record) => $record->stock) // Tugas Praktikum: Badge dinamis berdasarkan stok
                            ->badgeColor(fn ($record) => $record->stock < 10 ? 'danger' : 'success') // Tugas Praktikum: Warna badge berbeda
                            ->schema([
                                TextEntry::make('price')
                                    ->label('Product Price')
                                    ->weight('bold')
                                    ->color('primary')
                                    ->icon('heroicon-o-currency-dollar')
                                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                                TextEntry::make('stock')
                                    ->label('Product Stock')
                                    ->weight('bold')
                                    ->color('primary')
                                    ->icon('heroicon-o-archive-box'),
                            ])->columns(2),

                        // Tab 3: Media & Status
                        Tabs\Tab::make('Image and Status')
                            ->icon('heroicon-o-photo') // Tugas Praktikum: Icon spesifik
                            ->schema([
                                ImageEntry::make('image')
                                    ->label('Product Image')
                                    ->disk('public'),
                                IconEntry::make('is_active')
                                    ->label('Is Active?')
                                    ->boolean(),
                                IconEntry::make('is_featured')
                                    ->label('Is Featured?')
                                    ->boolean(),
                            ])->columns(3),
                    ])
                    ->columnSpanFull(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
