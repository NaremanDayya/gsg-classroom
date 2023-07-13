<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
// use App\Test;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\View\View as BaseView;
use Illuminate\Support\Str;
class ClassroomsController extends Controller
{
    // public function index(Request $requset , Test $test)
    public function index(Request $requset):BaseView
    {

        $classrooms = Classroom::orderBy('name','DESC')->get();
        // $classroom = Classroom::orderBy('name','DESC')->first();
        // session()->get('success');//ممكن يكون null
        // session()->has('success');
        // Session::put('success','');
        $success = session('success');
        return view('classrooms.index' , compact('classrooms','success'));


        // echo $requset->url();
        // echo $test->print();
        // return 'Hello';
        // $name='Nareman';
        // $title='Laravel Training';
        // return view('classrooms.index',compact('name','title'));
        // return Redirect::away('باث خارجي');
        // return Redirect::to('باث داخل الموقع نفسه');
        // return view('classrooms.index',[
        //     'name' => 'Nareman',
        //     'title' => 'Laravel Training'
        // ]);
    }

    public function create()
    {
        return View()->make('classrooms.create')
        ->with('success', 'Classroom Created successfully');
        // return view('classrooms.create');
    }

    public function store(Request $request): RedirectResponse
    {
        //method 1
        // $classroom = new Classroom();
        // $classroom->name = $request->post('name');
        // $classroom->subject = $request->post('subject');
        // $classroom->section = $request->post('section');
        // $classroom->room = $request->post('room');
        // $classroom->code = Str::random(8);
        // $classroom->save();

        //method 2
        // $data= $request->all();
        // $data['code'] = Str::random(8);
        // Classroom::create([$data]);
        // $classroom = new Classroom();
        //  $classroom->fill($request->all())->save();

        //method 3
        if ($request->hasFile('cover_image'))
        {
            $file = $request->file('cover_image');
             $path=$file->store('/covers','uploads');
            // $path=$file->storeAs('/covers','nana.png','uploads');//عنا هنا بنختار الاسم بس بدنا نركز على فكرىة تكرار الاسماء ونحلهاا           
            $request->merge([
                'cover_image_path' => $path,
            ]);
        }

        $request->merge([
            'code' => Str::random(8),
        ]);
        $classroom =Classroom::create($request->all());
        return redirect()->route('calssrooms.index')
        ->with('success' , 'your classroom created successfully');
        

        // echo $request->query('name');//رح ترجع القيم من ال url
        // echo $request->input('name');//بترجع القيمة من ال body |url
        // echo $request->post('name');//بترجع من الفورم حس الname تبع الحقل
        // // echo $request->name;
        // $request->all();//كل الحقول
        // $request->only();
        // $request->except();


    }
    
    public function show($id)
    {
        // $classrooom =Classroom::where('id' , '=' , $id)->first();
        $classroom = Classroom::findOrFail($id);
        return View::make('classrooms.show')
        ->with([
            'classroom' => $classroom,
        ]);
        // return view('classrooms.show',[
        //     'id' => $id,
        //     'edit' => $edit
        // ]);
    }

    public function edit($id)
    {
        
        $classroom = Classroom::findOrFail($id);
        //Fail بتغنينا عنها 
        // if(!$classroom)
        // {
        //     abort(404);
        // }
        return view('classrooms.edit',[
            'classroom' => $classroom,
        ]);
    }
    public function update(Request $request , $id)
    {
      //method 1
        $classroom =Classroom::findOrFail($id);
        $old_image=$classroom->cover_image_path;
        $data = $request->except('cover_image_path');
        $new_image = $request->file('cover_image')->store('/covers', 'uploads');
        $data['cover_image_path']=$new_image;     
        $classroom->update($data);
        
        if($old_image && $new_image){

            Storage::disk('uploads')->delete($old_image);

        }
        // $classroom->name = $request->post('name');
        // $classroom->subject = $request->post('subject');
        // $classroom->section = $request->post('section');
        // $classroom->room = $request->post('room');
        // $classroom->save();   
      //mass Assignment
    //   $classroom->fill($request->all())->save();
        Session::flash('success' , 'your classroom updated successfully');
        return Redirect::route('calssrooms.index');

    }

    public function destroy($id)
    {
        $classroom = Classroom::findOrFail($id);
        $classroom->destroy($id);
        //Flash Message
        return redirect(route('calssrooms.index'))
        ->with('success' , 'your classroom deleted successfully');
        // Classroom::where('id','=',$id)->delete();
        // $classroom = Classroom::find($id);
        // $classroom->delete();
    }
}