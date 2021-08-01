<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    use Translatable;
    protected $with = ['translations'];
    protected $guarded = [];
    public $translatedAttributes = ['name'];


    public function Option(){

        return $this->hasMany(Option::class,'attribute_id');
    }


}
