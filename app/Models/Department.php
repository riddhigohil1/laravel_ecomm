<?php

namespace App\Models;

use App\Filament\Resources\Departments\RelationManagers\CategoriesRelationManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);   
    }
   
}
