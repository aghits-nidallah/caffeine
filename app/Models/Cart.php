<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory, SoftDeletes;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function store()
    {
        return $this->hasOneThrough(
            Store::class,
            Product::class,
            'user_id',
            'user_id',
            'user_id',
        );
    }

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];
}
