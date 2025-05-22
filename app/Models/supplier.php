<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class supplier extends Model
{
    /** @use HasFactory<\Database\Factories\SupplierFactory> */
    use HasFactory;

    public function product(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function Transactions(): MorphMany
    {
        return $this->morphMany(Transaction::class);
    }

    

}
