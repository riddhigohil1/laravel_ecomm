<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    // If variation_option_ids is stored as JSON
    protected $casts = [
        'variation_option_ids' => 'array',
    ];
}
