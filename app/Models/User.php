<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $primaryKey = 'user_id';

    public function getUserStatusAttrribute(){
        switch ($this->user_status) {
            case 'admin':
                return 'Admin';
                break;

            case 'worker':
                return 'İşçi';
                break;
            
            default:
                return 'İstifadəçi';
                break;
        }
    }
}
