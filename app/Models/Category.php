<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'item_category'; 
    protected $fillable = ['id','category_name'];

    public $timestamp = true;

    public function Category(){
        return $this->hasMany(Category::class);
    }
}
