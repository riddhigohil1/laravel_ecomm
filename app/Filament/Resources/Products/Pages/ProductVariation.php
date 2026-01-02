<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected static string | BackedEnum | null $navigationIcon = '';

    protected static ?string $navigationLabel = 'Stock & Price'; 

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
        $types = $this->record->variations;
        $fields = [];
 
        foreach($types as $type)
        {
            $fields[] = Hidden::make('variation_'.($type->id).'.id');
            $fields[] = TextInput::make('variation_'.($type->id).'.name')
                        ->label($type->name)->readOnly(true);
        }

        return $schema
            ->components([
                Repeater::make('variations')
                    ->collapsible()
                    ->addable(false)
                    ->hiddenLabel()
                    ->defaultItems(1)
                    ->schema([
                        Section::make()
                            ->schema($fields)
                            ->columns(3)
                            ->contained(false) 
                            ->columnSpan('full'),
                        TextInput::make('quantity')
                            ->label('Quantity')
                            ->numeric(),
                        TextInput::make('price')
                            ->label('Price')
                            ->numeric(),
                    ])
                    ->columns(2)
                    ->columnSpan(2)

            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $existingData = $this->record->productVariations->toArray();
        $data['variations'] = $this->mergeCartesianWithExisting($this->record->variations, $existingData);
 
        return $data;
    }

    private function mergeCartesianWithExisting($variations, $existingData) : array
    {
        
        $defaultQuntity = $this->record->quantity;
        $defaultPrice = $this->record->price;
        $cartesianProduct = $this->cartesianProduct($variations, $defaultQuntity, $defaultPrice);
 
        $mergedResult = [];

        foreach($cartesianProduct as $product){
            $optionIds = collect($product)
                            ->filter(fn($value, $key) => str_starts_with($key, 'variation_'))
                            ->map(fn($option) => $option['id'])
                            ->values()
                            ->toArray();

            $match = array_filter($existingData, function($existingOption) use ($optionIds){
                if(isset($existingOption['variation_option_ids']))
                    return $existingOption['variation_option_ids'] === $optionIds;
            });
            
            
            if(!empty($match))
            {
                $existingEntry = reset($match);
                $product['id']=$existingEntry['id'];
                $product['quantity'] = $existingEntry['quantity'];
                $product['price'] = $existingEntry['price'];
            }
            else{
                $product['quantity'] = $defaultQuntity;
                $product['price'] = $defaultPrice;
            }

            $mergedResult[] = $product;
        }

        return $mergedResult;
    }

    private function cartesianProduct($variations, $defaultQuntity = null, $defaultPrice = null): array
    {
        $result = [[]];

        foreach($variations as $index => $variation)
        {
            $temp = [];

            foreach($variation->options as $option)
            {
                foreach($result as $combination)
                {
                    $newCombination = $combination + [
                        'variation_'.($variation->id) => [
                            'id'=>$option->id,
                            'name'=>$option->name,
                            'type'=>$variation->name,
                        ],
                    ];

                    $temp[] = $newCombination;
                }
            }
            
            $result = $temp;
        }

        foreach($result as &$combination)
        {
            if(count($combination) === count($variations))
            {
                $combination['quantity'] = $defaultQuntity;
                $combination['price'] = $defaultPrice;
            }
        }

        return $result;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $formattedData = [];

        foreach($data['variations'] as $option)
        {
            $variationTypeOptionIds = [];

            foreach($this->record->variations as $i => $variationType)
            {
                if(isset($option['variation_'.($variationType->id)]['id']))
                    $variationTypeOptionIds[] = $option['variation_'.($variationType->id)]['id'];
            }

            $quantity = $option['quantity'];
            $price = $option['price'];

            if(isset($option['id']))
            {
                $formattedData[] = [
                'id'=> $option['id'],
                'variation_option_ids' => $variationTypeOptionIds,
                'quantity' => $quantity,
                'price'=>$price,
                ];
            }
            else{
                $formattedData[] = [
                'variation_option_ids' => $variationTypeOptionIds,
                'quantity' => $quantity,
                'price'=>$price,
                ];
            }
            
        }

        $data['variations'] = $formattedData;

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $variations = $data['variations'];
        unset($data['variations']);

        $variations = collect($variations)->map(function ($variation){

            if(isset($variation['id']))
            {
                $varArr = [ 
                    'id'=>$variation['id'],
                    'variation_option_ids' => json_encode($variation['variation_option_ids']),
                    'quantity'=>$variation['quantity'],
                    'price'=>$variation['price']
                ];
            }
            else{
                $varArr = [ 
                    'variation_option_ids' => json_encode($variation['variation_option_ids']),
                    'quantity'=>$variation['quantity'],
                    'price'=>$variation['price']
                ];
            }
            return $varArr;
        })
        ->toArray();

        $record->productVariations()->upsert($variations, ['id'], ['variation_option_ids', 'quantity', 'price']);

        return $record;
    }
}
