<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    use HasFactory;

    public $table='adverts';
    protected $primaryKey = 'advert_id';
	
	public function getSubCategory(){
        return $this->hasOne(SubCategory::class, 'subcategory_id', 'advert_subcategory');
    }
}
