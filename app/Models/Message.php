<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    protected $fillable = ['from_id','to_id','message','is_read'];

    public function sender() {
        return $this->belongsTo(User::class, 'from_id');
    }

    public function receiver() {
        return $this->belongsTo(User::class, 'to_id');
    }

    public function lastMessage()
    {
        return $this->hasOne(Message::class, 'from_id')->orderBy('id', 'desc');
    }

}
