<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia;

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(100);

        $this->addMediaConversion('small')
            ->width(480);

        $this->addMediaConversion('large')
            ->width(1200);
    }

    public function scopeForVendor(Builder $query): Builder
    {
        return $query->where('created_by', auth()->user()->id);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('active', true);
    }
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function variationOption() : HasMany {
        return $this->hasMany(VariationOption::class);
    }
    public function variations(): HasMany
    {
        return $this->hasMany(Variation::class);
    }
  
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function productVariations() : HasMany {
        return $this->hasMany(ProductVariation::class, 'product_id');
    }

    public function getPriceForOptions($optionIds = [])
    {
        $optionIds = array_values($optionIds);
        sort($optionIds);

        foreach($this->variations as $variation)
        {
            $a = $variation->variation_type_option_ids;
            if ($a) sort($a);
            if($optionIds == $a)
                return $variation->price !== null ? $variation->price : $this->price;
        }

        return $this->price;
    }

    public function getImageForOptions(array $optionIds = null) 
    {
        if($optionIds)
        {
            $optionIds = array_values($optionIds);
            sort($optionIds);
            $options = VariationOption::whereIn('id', $optionIds)->get();

            foreach($options as $option)
            {
                $image = $option->getFirstMediaUrl('images', 'small');
                if($image)
                    return $image;
            }
        }

        return $this->getFirstMediaUrl('images', 'small');
    }
}
