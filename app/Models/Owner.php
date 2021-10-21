<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;

    public $table='owners';
    protected $primaryKey = 'owner_id';
	
	public function getOwnerOnlineAttrribute(){
        switch ($this->owner_online) {
            case 'online':
                return 'Online';
                break;
            
            default:
                return 'Offline';
                break;
        }
    }
}
