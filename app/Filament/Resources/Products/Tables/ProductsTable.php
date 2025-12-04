<?php

namespace App\Filament\Resources\Products\Tables;

use App\Enum\ProductStatusEnum;
use App\Models\Product;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->sortable()
                    ->words(10)
                    ->searchable(),
                TextColumn::make('department.name'),
                TextColumn::make('category.name'),
                TextColumn::make('status')
                    ->badge()
                    ->sortable()
                    ->colors(ProductStatusEnum::colors()),
                IconColumn::make('variation')
                    ->boolean(),
                ToggleColumn::make(name: 'active'),
                TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(ProductStatusEnum::labels()),
                SelectFilter::make('department_id')
                    ->relationship('department', 'name')
                    ->label('Department')
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('images')
                    ->url(fn (Product $record): string => route('filament.admin.resources.products.images', $record))
                    ->icon('heroicon-m-photo'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
