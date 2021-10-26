<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Store extends Model
{
    use HasFactory, SoftDeletes;

    public function product()
    {
        return $this->hasMany(Product::class, 'user_id', 'user_id');
    }

    public function getPictureUrlAttribute()
    {
        return $this->picture == NULL
            ? route('icon', ['value' => $this->id, 'size' => 500])
            : Storage::url('store_pictures/' . $this->picture);
    }

    public function getBannerUrlAttribute()
    {
        return $this->banner == NULL
            ? route('icon', ['value' => 'banner-' . $this->id, 'size' => 500])
            : Storage::url('store_banners/' . $this->banner);
    }

    public function checkouts()
    {
        return $this->hasMany(Checkout::class);
    }

    protected $fillable = [
        'user_id',
        'name',
        'picture',
        'banner',
        'description',
        'payment_note',
    ];

    protected $appends = [
        'picture_url',
        'banner_url',
    ];
}
