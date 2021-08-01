<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeTranslation extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public  $timestamps = false;

//    public  function options(){
//        return $this->hasMany(Option::class,'attribute_id');
//    }
}
