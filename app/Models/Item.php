<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';
    // protected $fillable = ['imei', 'user_id'];
    protected $fillable = ['imei'];

    // public function user()
    // {
    // 	return $this->belongsTo(User::Class);
    // }
}
