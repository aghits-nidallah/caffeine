<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    public function getFirstPictureUrlAttribute()
    {
        return $this->hasMany(ProductPicture::class)->where('order', 0)->first() != null
            ? Storage::url('public/product_pictures/' . $this->hasMany(ProductPicture::class)->where('order', 0)->first()->storage_name)
            : route('icon', ['value' => $this->id, 'size' => 500]);
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'user_id', 'user_id');
    }
    
    public function pictures()
    {
        return $this->hasMany(ProductPicture::class);
    }

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'stock',
        'price',
        'active',
    ];

    protected $appends = [
        'first_picture_url',
    ];
}
