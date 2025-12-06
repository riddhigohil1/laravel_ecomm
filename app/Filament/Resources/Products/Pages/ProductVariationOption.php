<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Repeater;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Schema;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;

class ProductVariationOption extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected static string | BackedEnum | null $navigationIcon = '';
    protected static ?string $navigationLabel = 'Variation'; 

    protected function authorizeAccess(): void
    {
        //only for product has variation
        abort_unless($this->record->variation, 403);
    }

    public function getTitle(): string
    {
        // Just return the record's title without "Edit"
        return $this->record->title;
    }
    
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Repeater::make('variations')
                ->relationship()
                    ->collapsible()
                    ->defaultItems(1)
                    ->addActionLabel('Add New Variant')
                    ->columns(2)
                    ->columnSpan(2)
                    ->hiddenLabel()
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->label('Variant Name'),
                        Repeater::make('options')
                            ->hiddenLabel()
                            ->addActionLabel('Add New Variant Option')
                            ->relationship()
                            ->collapsible()
                            ->schema([
                                TextInput::make('name')
                                    ->columnSpan(2)
                                    ->required(),
                            ])
                            ->columnSpan(2)
                            ->defaultItems(3)
                            ->grid(3),
                    ])
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
