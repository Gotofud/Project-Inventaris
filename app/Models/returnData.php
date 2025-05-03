<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class returnData extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'return_code',
        'amount',
        'return_date',
        'brws_name',
        'brws_id',
        'status',
        'item_id'
    ];

    public $timestamp = true;

    public function mainData(){
        return $this->belongsTo(mainDatas::class, 'item_id','id');
    }
}
