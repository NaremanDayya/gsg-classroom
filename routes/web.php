
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassroomsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopicsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/ 

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('/topics/trashed')
->as('topics.')
->controller(TopicsController::class)
->group(function(){
    Route::get('/','trashed')
->name('trashed');
Route::put('/{topic}','restore')
->name('restore');
Route::delete('/{topic}','forceDelete')
->name('force-delete');
})->middleware('auth');
Route::middleware(['auth'])->group(function () {
    
Route::prefix('/classrooms/trashed')
->as('classrooms.')
->controller(ClassroomsController::class)
->group(function(){
    Route::get('/','trashed')
->name('trashed');
Route::put('/{classroom}','restore')
->name('restore');
Route::delete('/{classroom}','forceDelete')
->name('force-delete');
});



Route::get('/classroom', [ClassroomsController::class ,'index'])
->name('calssrooms.index');
Route::get('/classrooms/create',[ClassroomsController::class ,'create'])
->name('calssrooms.create');
Route::post('/classrooms',[ClassroomsController::class ,'store'])
->name('calssrooms.store');
//Route::get('/classrooms/create',[ClassroomsController::class ,'index']);رح يرجع التاني لو كانوا نفس الميثود والباث 
  
Route::get('/classrooms/{id}/edit',[ClassroomsController::class ,'edit'])
->name('classrooms.edit');
// Route::get('/classrooms/{id:code}/edit',[ClassroomsController::class ,'edit'])
// ->name('classrooms.edit');//رح يفهم انه يبحث حسب الكود مش ال id 
Route::get('/classrooms/{id}',[ClassroomsController::class ,'show'])
->name('classrooms.show')
->where('id','\d+');
Route::put('/classrooms/{id}',[ClassroomsController::class ,'update'])
->name('classrooms.update')
->where('id','\d+');
Route::delete('/classrooms/{id}',[ClassroomsController::class ,'destroy'])
->name('classrooms.destroy');
// ->where('edit','yes|no');//digit or more
// ->where('id','[0-9]+');//digit or more
//->where('id','.+');//any character


Route::resource('classroom.topic', TopicsController::class);
//عنا بتفرتض انه اسم الباراميتر هو المفرد من الكلاس
});
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');  
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
