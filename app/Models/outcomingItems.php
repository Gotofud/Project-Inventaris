<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class outcomingItems extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'out_code',
        'amount',
        'exit_date',
        'info',
        'item_id'
    ];

    public $timestamp = true;

    public function mainData(){
        return $this->belongsTo(mainDatas::class, 'item_id','id');
    }

    public function Category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
