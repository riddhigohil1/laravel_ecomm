<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Enum\ProductStatusEnum;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(
                    function ($state, callable $set)
                    {
                        $set('slug', Str::slug($state));
                    }
                ),
                TextInput::make('slug')
                    ->required(),
                Select::make('department_id')
                    ->relationship('department', 'name')
                    ->label('Department')
                    ->preload()
                    ->searchable()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function (callable $set) {
                        $set('category_id', null);
                    }),
                Select::make('category_id')    
                    ->relationship('category','name', function(Builder $query, callable $get)
                    {
                        $departmentId = $get('department_id');
                        if($departmentId)
                        {
                            $query->where('department_id', $departmentId);
                        }
                    })
                    ->label('Category')
                    ->preload()
                    ->searchable()
                    ->required(),
                RichEditor::make('description')
                    ->required()
                     ->toolbarButtons([
                        'blockquote', 'bold', 'bulletList', 'h2', 'h3', 'italic', 'link', 'orderedList', 'redo', 'strike', 'underline', 'undo', 'table'
                    ])
                    ->columnSpan(2),
                Grid::make(3)
                    ->schema([
                        TextInput::make('price')
                            ->required()
                            ->numeric(),
                        TextInput::make('quantity')
                            ->integer(),
                        Select::make('status')
                            ->options(ProductStatusEnum::labels())
                            ->default(ProductStatusEnum::IN_STOCK->value)
                            ->required(),
                        ])
                    ->columnSpanFull(),
                
                Checkbox::make('variation')   
                    ->label('This product has variations'),
                Toggle::make('active')
                    ->inline(),
                
            ]);
    }
}
