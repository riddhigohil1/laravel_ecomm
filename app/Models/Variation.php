<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Variation extends Model
{    
    public $timestamps = false;
    
    public function options()
    {
        return $this->hasMany(VariationOption::class, 'variation_id');
    }
}
