<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $table = "Rooms";
    protected $fillable = [
        'id',
        'room_code',
        'room_name',
        'item_id'
    ];

    public $timestamp = true;

    public function mainDatas(){
        return $this->belongsTo(mainDatas::class,'item_id','id');
    }
}
