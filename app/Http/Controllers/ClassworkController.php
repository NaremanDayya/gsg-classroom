<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassworkRequest;
use App\Models\Classroom;
use App\Models\Classwork;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClassworkController extends Controller
{
    protected function getType(Request $request)
    {
        $type =$request->query('type') ;
        // $type =request()->query('type') ;
        $allowed_types = [
            Classwork::TYPE_ASSAIGNMENT , Classwork::TYPE_MATERIAL , Classwork::TYPE_QUESTION
        ];
        if(!in_array($type,$allowed_types)) {
            $type =Classwork::TYPE_ASSAIGNMENT ;
        }
        return $type;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Classroom $classroom)
    {

        // $classworks =$classroom->classworks()->get();
        // $classworks =$classroom->classworks;//هنا لحاله حيعمل get لما استدعيها كانها property
        // $assignments =$classroom->classworks()//هنا رح يرجع اوبجكت الريليشن
        // ->where('type','=',Classwork::TYPE_ASSAIGNMENT)
        // ->get();
        $classworks =$classroom->classworks()
        ->with('topic') //Eager load
        ->orderBy('published_at')
        ->filter(request(['search']))
        ->get();
        return view('classworks.index',[
            'classroom' => $classroom, 
            'classworks' => $classworks->groupBy('topic_id')
        ]);
    }


    /**+
     * Show the form for creating a new resource.
     */
    public function create(Request $request, Classroom $classroom)
    {
        // $type =$request->query('type') ;
        // // $type =request()->query('type') ;
        // $allowed_types = [
        //     Classwork::TYPE_ASSAIGNMENT , Classwork::TYPE_MATERIAL , Classwork::TYPE_QUESTION
        // ];
        // if(!in_array($type,$allowed_types)) {
        //     $type =Classwork::TYPE_ASSAIGNMENT ;
        // }
        $type = $this->getType($request);
        $classwork = new Classwork();
        return view('classworks.create',compact('classroom','classwork','type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClassworkRequest $request,Classroom $classroom, Classwork $classwork)
    {
        $type = $this->getType($request);

        $validated =$request->validated();
        $request->merge([
            'user_id' => Auth::id(),
            // 'classroom_id' =>$classroom->id,
            'type' => $type,
        ]);
        try{
        DB::transaction(function () use($classroom ,$request ,$type) {
        // Classwork::create($request->all());
        // $data= [
        //     'user_id' => Auth::id(),
        //     // 'classroom_id' =>$classroom->id,
        //     'type' => $type,
        //     'title' => $request->input('title'),
        //     'description' => $request->input('description'),
        //     'topic_id' => $request->input('topic_id'),
        //     // 
        //     // 'options' => json_encode([
        //     //     'grade' => $request->input('grade'),
        //     //     'due' => $request->input('due'),
        //     // ]),  
        //     //بعد ما ضفنا الcast على المودل
        //     'published_at' => $request->input('published_at'),
        //     'options' => $request->input('options'),//طالما خلينا اسماء الحقول بدلاة مصفوفة لل options
        //     // 'options' => [
        //     //     'grade' => $request->input('grade'),
        //     //     'due' => $request->input('due'),
        //     // ],
        // ];
        $classwork =$classroom->classworks()->create($request->all());//هنا صار يمرر قيمة الكلاس روم لحاله بدون ما اعمل الها merge


        $classwork->users()->attach($request->input('students'));
   
        });
    }
    catch(QueryException $e){
        return back()->with('error',$e->getMessage());
    }

    return redirect()->route('classroom.classwork.index', $classroom->id)
        ->with('success', "Classwork $classwork->title Created♥");
}
    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom,Classwork $classwork)
    {
        // $classwork->load('comments.user');//eagr loading with model pinding
        return view('classworks.show',compact('classroom','classwork'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request ,Classroom $classroom,Classwork $classwork)
    {
        // $classwork = $classroom->classworks()->findOrFail($classwork->id);
        $type = $classwork->type->value;//لانه نوعه صار enum
        $assigned =$classroom->users()->pluck('id')->toArray();//pluckبترجعلنا collection واحنا بنتعامل مع array
        return view('classworks.edit',compact('classroom','classwork','type','assigned'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClassworkRequest $request, Classroom $classroom,Classwork $classwork)
    {
        $validated = $request->validated();
        $classwork->update($validated);
        $classwork->users()->sync($request->input('students'));
        return back()
        ->with('success', 'Classwork Updated♥');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom,Classwork $classwork)
    {
        $classwork = $classroom->classworks()->findOrFail($classwork->id);
        $classwork->delete();
        return redirect(route('calssrooms.index'))
        ->with('success', "your classwork $classwork->title deleted successfully");
    
    }
}
