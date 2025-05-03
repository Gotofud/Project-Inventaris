<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class incomingItems extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'icm_code',
        'amount',
        'entry_date',
        'info',
        'item_id'
    ];

    public $timestamp = true;

    public function mainData(){
        return $this->belongsTo(mainDatas::class, 'item_id','id');
    }

}
