<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use Translatable;
    use HasFactory;

    protected $with = ['translations'];


    protected $translatedAttributes = ['name'];

    protected $fillable = ['slug'];

    protected $hidden = ['translations'];

    public function scopeActive ($query){
        return $query->where('is_active',1 );
    }
}
