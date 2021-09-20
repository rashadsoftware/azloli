<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;
    public $table='configs';
    public $primaryKey='config_id';

    public function getPhoneAttribute() {
        $phone = $this->config_phone;
    
        $prefix = substr($phone, 1, 2);
        $suffix3 = substr($phone, 3, 3);
        $suffix2 = substr($phone, 6, 2);
        $suffix = substr($phone, 8, 2);
    
        return "{$prefix} {$suffix3}-{$suffix2}-{$suffix}";
    }
}
