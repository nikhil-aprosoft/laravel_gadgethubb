<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentCategory extends Model
{
    use HasFactory;

    protected $table = 'parent_categories';
  
    protected $fillable = [
        'name',
        'rank',
        'desc',
        'icon'
    ];

    public function categories()
    {
        return $this->hasMany(Category::class, 'parent_category_id');
    }
   
}
