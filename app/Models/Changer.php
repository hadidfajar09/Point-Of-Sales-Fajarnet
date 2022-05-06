<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Changer extends Model
{
    use HasFactory;
    
    protected $table = 'changers';

    protected $guarded = [];

    public function member()
    {
        return $this->belongsTo(Member::class, 'id_member', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }
}
