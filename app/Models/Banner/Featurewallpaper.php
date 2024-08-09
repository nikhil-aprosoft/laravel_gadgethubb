<?php

namespace App\Models\Banner;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Featurewallpaper extends Model
{
    use HasFactory;
   
    protected $table = 'feature_wallpapers';
   
    public function getImageAttribute($value)
    {
        return url('storage/featurewallpaper/' . $value);
    }
}
