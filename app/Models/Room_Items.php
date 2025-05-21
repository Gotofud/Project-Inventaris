<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room_Items extends Model
{
    use HasFactory;
    protected $table = "room_items";
    protected $fillable = [
        'id',
        'amount',
        'item_id',
        'rooms_id'
    ];

    public $timestamp = true;

    public function mainData(){
        return $this->belongsTo(mainDatas::class,'item_id','id');
    }
    public function rooms(){
        return $this->belongsTo(Room::class,'rooms_id','id');
    }
}
