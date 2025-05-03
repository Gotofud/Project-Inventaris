<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mainDatas extends Model
{
    use HasFactory;
    protected $table = 'maindatas';
    protected $fillable = [
        'id',
        'prd_code',
        'name',
        'category_id',
        'stock'
    ];
    public $timestamp = true;
        
    public function deleteImage(){
        if ($this->img && file_exists(public_path('images/data/' . $this->img))){
            return unlink(public_path('images/data/' . $this->img));
        } 
        return false;
    }

    public function mainDatas(){
        return $this->hasMany(mainDatas::class);
    }

    public function Category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
