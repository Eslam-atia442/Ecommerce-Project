<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingTranslation extends Model
{
    use HasFactory;
//    protected $fillable=['value']; or     protected $guarded=[''];

    protected $guarded=[];
    public $timestamps=false;
}
