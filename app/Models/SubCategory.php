<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    public $table='subcategories';
    protected $primaryKey = 'subcategory_id';
	
	public function getCategory(){
        return $this->hasOne(Category::class, 'category_id', 'categoryID');
    }
}
