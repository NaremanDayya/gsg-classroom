<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name' ,'subject','section' , 'room', '_Token', 'theme', 'cover_image_path', 'code'
    ];

    // protected $guarded = [ 'id'];//not recommended
    // public function getRouteKeyName()
    // {
    //     //حيفهم هان انو اباراميتر تبع الراوتس هو الكود
    //     return 'code';
    // }
}
