<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    public $table='messages';
    protected $primaryKey = 'message_id';

    public function getUserChat(){
        return $this->hasOne(User::class, 'user_id', 'message_user');
    }

    public function getOwnerChat(){
        return $this->hasOne(Owner::class, 'owner_id', 'message_owner');
    }
}
