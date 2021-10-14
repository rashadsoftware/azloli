<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
    use HasFactory;

    public $table='skills';
    protected $primaryKey = 'skill_id';

    public function getSubCategory(){
        return $this->hasOne(SubCategory::class, 'subcategory_id', 'subcategoryID');
    }
	
	public function getUser(){
        return $this->hasOne(User::class, 'user_id', 'userID');
    }
}
