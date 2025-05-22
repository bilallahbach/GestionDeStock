<?php

namespace App\Models;

use App\Models\Store;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stock extends Model
{
    /** @use HasFactory<\Database\Factories\StockFactory> */
    use HasFactory;

    public function Product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    } 

    public function Store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    } 
}
