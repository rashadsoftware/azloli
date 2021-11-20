<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checks extends Model
{
    use HasFactory;

    public $table='checks';
    protected $primaryKey = 'check_id';
	
	public function getAdvert(){
        return $this->hasOne(Advert::class, 'advert_id', 'advertID');
    }
}
