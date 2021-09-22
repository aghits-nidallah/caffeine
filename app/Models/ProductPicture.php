<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class ProductPicture extends Model
{
    use HasFactory, SoftDeletes;

    public function getPictureUrlAttribute()
    {
        return Storage::url('public/product_pictures/' . $this->storage_name);
    }
    
    protected $fillable = [
        'order',
        'product_id',
        'storage_name',
        'original_name',
    ];
}
