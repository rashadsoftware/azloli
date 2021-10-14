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

    public function getPhoneAttribute() {
        $phone = $this->user_phone;
    
        $prefix = substr($phone, 1, 2);
        $suffix3 = substr($phone, 3, 3);
        $suffix2 = substr($phone, 6, 2);
        $suffix = substr($phone, 8, 2);
    
        return "{$prefix} {$suffix3}-{$suffix2}-{$suffix}";
    }
}
