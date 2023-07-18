<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Classroom extends Model
{
    use HasFactory;
    public static string $disk = 'uploads';

    protected $fillable = [
        'name' ,'subject','section' , 'room',
         '_Token', 'theme', 'cover_image_path', 'code'
    ];

    public static function uploadCoverImage($file)
    {
        $path = $file->store('/covers', [
            'disk' => self::$disk,
        ]);
        return $path;
    }

    public static function deleteCoverImage($path)
    {
      return Storage::disk(self::$disk)->delete($path);

    }

    // protected $guarded = [ 'id'];//not recommended
    // public function getRouteKeyName()
    // {
    //     //حيفهم هان انو اباراميتر تبع الراوتس هو الكود
    //     return 'code';
    // }
}
