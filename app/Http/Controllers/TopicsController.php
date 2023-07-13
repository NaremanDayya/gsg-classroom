<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Topic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\View\View as BaseView;
use Illuminate\Support\Str;


class TopicsController extends Controller
{
    public function index(): BaseView
    {
        $topics = Topic::join('classrooms' ,'classroom_id', '=' , 'topics.classroom_id')
        ->select([
            'topics.*',
            'classrooms.name as category_name',
        ])->paginate();
        return view('topics.index',[
            'topics' => $topics,
        ]);
    }

    public function create()
    {
        $classrooms = Classroom::all();
        return view('topics.create',[
            'classrooms' => $classrooms,
        ]);
    }

    public function store(Request $request)
    {
        $topic= Topic::create($request->all());
        return redirect()->route('topics.index');
    }

    public function show($id)
    {
        $topics = Topic::join('classrooms' ,'classrooms.id', '=' , 'topics.classroom_id')
        ->select([
            'topics.*',
            'classrooms.name as classroom_name',
           
        ])->where('topics.id', $id)
        ->first(); 
            return view('topics.show',[
            'topic' => $topics,
        ]);

    }

    public function edit($id)
    {
        $topic = Topic::join('classrooms' ,'classrooms.id', '=' , 'topics.classroom_id')
        ->select([
            'topics.*',
            'classrooms.name as classroom_name',
           
        ])->where('topics.id', $id)
        ->first(); 
                return view('topics.edit',[
            'classrooms' => Classroom::all(),
            'topic' =>$topic
        ]);
    }

    public function update(Request $request, $id)
    {
        $topic = Topic::findOrFail($id);
        $topic->update($request->all());
        return redirect()->route('topics.index');

    }

    public function destroy($id)
    {
        Topic::destroy($id);
    }

}
