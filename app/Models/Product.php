<?php

namespace App\Models;

use App\Models\Stock;
use App\Models\Category;
use App\Models\supplier;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description',
        'price',
        'category_id',
        'supplier_id',
        'stock',
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(supplier::class);
    }

    public function Category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }    

    public function Stock(): HasOne
    {
        return $this->hasOne(Stock::class);
    }

    public function Transaction(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function Order(): HasOneThrough
    {
return $this->hasOneThrough(
    Customer::class, // Final model (e.g., customer)
    Order::class     // Intermediate model (e.g., order)
);


    }
}
