<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClassroomCollection;
use App\Http\Resources\ClassroomResource;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;
use Throwable;

class ClassroomsController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $this->withoutWrapping();
        // return Classroom::all();//رح يحول الكوليكشن لjson 
        if(!Auth::guard('sanctum')->user()->tokenCan('classrooms.read')){
            abort(404);
        }
        $classrooms = Classroom::with('user:id,name', 'topics')
            ->withCount('students as std')
            ->paginate(3);
            // return response()->json($Classrooms, 200, [
            //     'x-test' => 'test',
            // ]);
            // return ClassroomResource::collection(($classrooms), 200, [
            //     'x-test' => 'test',
            // ]);
            return new ClassroomCollection($classrooms);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::guard('sanctum')->user()->tokenCan('classrooms.create')){
            abort(404);
        }
        // try{
            $request->validate([
            'name' => 'required',
        ]);
        // }catch(Throwable $e) {
        //     return Response::json([
        //         'message'=>'name is required',
        //     ]);
        // }
       $classroom = Classroom::create($request->all());
       return [
        'code' => 100,
        'message' => __('Classroom created'),
        'classroom' => $classroom, 
    ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        if(!Auth::guard('sanctum')->user()->tokenCan('classrooms.show')){
            abort(404);
        }
        // return $classroom
        // ->load('user')
        // ->loadCount('students');
        return new ClassroomResource($classroom
        ->load('user')
        ->loadCount('students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom)
    {
        if(!Auth::guard('sanctum')->user()->tokenCan('classrooms.update')){
            abort(404);
        }
        $request->validate([
            // 'name' => ['sometimes','required',"unique:classrooms,name,$classroom->id",],//يعني يستثني قيمة اسم الكلاس الحالي من ال unique
            'name' => ['sometimes','required',Rule::unique('classrooms','name')->ignore($classroom->id)],
            'section' => ['sometimes','required'],
        ]);
    $classroom->update($request->all());
    return Response::json([
        'code' => 100,
        'message' => __('Classroom updated'),
        'classroom' => $classroom, 
    ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    { 
        if(!Auth::guard('sanctum')->user()->tokenCan('classrooms.destroy')){
        abort(404);
    }
        Classroom::destroy($id);
        return Response::json([],204);
            // 'code' => 100,
            // 'message' => __('Classroom deleted'),
        // ]);
    }
}
