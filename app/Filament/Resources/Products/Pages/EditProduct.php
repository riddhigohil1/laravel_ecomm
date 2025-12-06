<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected static string | BackedEnum | null $navigationIcon = '';

    public function getTitle(): string
    {
        // Just return the record's title without "Edit"
        return $this->record->title;
    }
    
    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
