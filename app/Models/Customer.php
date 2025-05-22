<?php

namespace App\Models;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;
    public function Order(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
    ];
    public function Transaction(): MorphMany
    {
        return $this->morphMany(Transaction::class);
    }
}
