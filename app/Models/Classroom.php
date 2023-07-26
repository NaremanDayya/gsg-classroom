<?php

namespace App\Models;

use App\Models\Scopes\UserClassroomScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Classroom extends Model
{
    use HasFactory;
    use SoftDeletes;
    public static string $disk = 'uploads';

    protected $fillable = [
        'name', 'subject', 'section', 'room','user_id',
        '_Token', 'theme', 'cover_image_path', 'code',
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
        if ($path && Storage::disk(Classroom::$disk)->exists($path))
            return Storage::disk(self::$disk)->delete($path);
    }
    // protected static function booted()
    protected static function boot()
    {
        parent::boot();//عنا فنكشن boot فكانه بنعمل الها over ride ف رح تعمللنا مشاكل 
        // static::addGlobalScope('user',function(Builder $query){
        //     $query->where('user_id' ,'=', Auth::id());
        // });
        static::addGlobalScope(new UserClassroomScope);
    }

    public function scopeActive(Builder $query)
    {
        $query->where('status', '=', 'active');
    }

    public function scopeRecent(Builder $query)
    {
        $query->orderBy('updated_at','DESC');
    }

    public function scopeStatus(Builder $query , $status = 'active')
    {
        $query->where('status' , '=', 'active');
    }



    // protected $guarded = [ 'id'];//not recommended
    // public function getRouteKeyName()
    // {
    //     //حيفهم هان انو اباراميتر تبع الراوتس هو الكود
    //     return 'code';
    // }
}
