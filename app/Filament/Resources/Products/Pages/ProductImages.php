<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Schema;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class ProductImages extends EditRecord
{
    protected static string $resource = ProductResource::class;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                SpatieMediaLibraryFileUpload::make('images')
                    ->hiddenLabel()
                    ->image()
                    ->multiple()
                    ->openable()
                    ->panelLayout('grid')
                    ->collection('images')
                    ->reorderable()
                    ->appendFiles()
                    ->preserveFilenames()
                    ->columnSpan(2)
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
