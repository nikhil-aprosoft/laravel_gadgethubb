<?php

namespace App\Models\Banner;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    public function getBannerImageAttribute($value)
    {
        return url('storage/banner_image/' . $value);
    }
}
