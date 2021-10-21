<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merge extends Model
{
    use HasFactory;

    public $table='merges';
    protected $primaryKey = 'merge_id';
    public $timestamps = false;

    public function getUserMerge(){
        return $this->hasOne(User::class, 'user_id', 'merge_user');
    }

    public function getOwnerMerge(){
        return $this->hasOne(Owner::class, 'owner_id', 'merge_owner');
    }
}
