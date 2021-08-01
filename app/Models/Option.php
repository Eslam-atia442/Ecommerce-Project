<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    use Translatable;
    protected $with = ['translations'];



    protected $fillable = ['attribute_id', 'product_id','price'];

    public $translatedAttributes = ['name'];


    public function Product (){
        return $this->belongsTo(Product::class,'product_id');
    }


    public function Attribute (){
        return $this->belongsTo(Attribute::class,'attribute_id');
    }
}
