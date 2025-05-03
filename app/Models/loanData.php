<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loanData extends Model
{
    protected $table = 'loanDatas';
    use HasFactory;
    protected $fillable = [
        'id',
        'loan_code',
        'amount',
        'loan_date',
        'brws_name',
        'status',
        'item_id'
    ];

    public $timestamp = true;

    public function mainData(){
        return $this->belongsTo(mainDatas::class, 'item_id','id');
    }

}
