<?php

namespace App\Http\Controllers;

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
    public function index($classroom): BaseView
    {
         $topics =Topic::where('classroom_id', '=', $classroom)->get();
        // Topic::join('classrooms', 'topics.topic_id', '=', 'topics.id')
        //     ->select([
        //         'topics.*',
        //         'topics.name as topic_name',
        //     ])->paginate();
            $success = session('success');
        return view('topics.index', [
            'topics' => $topics,
            'success' => $success,
            'classroom' => $classroom,
        ]);
    }

    public function create($classroom)
    {
        $topics = Topic::all();
        return view('topics.create', [
            'topics' => $topics,
            'classroom' => $classroom
        ])
        ->with('success', 'Topic Created ');
        
    }

    public function store(Request $request,$classroom)
    {
        $request['classroom_id'] = $classroom;
        $topics = Topic::create($request->all());
        return redirect(route('classroom.topic.index',$classroom))
        ->with( 'success', 'Topic Created' );
    }

    public function show($classroom ,$topic)
    {
        $topic = Topic::where('classroom_id', $classroom)->findOrFail($topic);
        return view('topics.show', [
            'topic' => $topic,
        ]);
    }

    public function edit($id)
    {
        $topic = Topic::join('topics', 'topics.id', '=', 'topics.topic_id')
            ->select([
                'topics.*',
                'topics.name as topic_name',

            ])->where('topics.id', $id)
            ->first();
        return view('topics.edit', [
            'topics' => Topic::all(),
            'topic' => $topic
        ]);
    }

    public function update(Request $request, $id)
    {
        $topic = Topic::findOrFail($id);
        $topic->update($request->all());
        return redirect()->route('classroom.topic.index')
        ->with('success', 'Topic updated');
        
    }

    public function destroy($id,$classroom)
    {
        $topic =Topic::where('classroom_id', '=', $classroom)->get();
        Topic::destroy($id);
        return redirect(route('classroom.topic.index',['classroom'=>$classroom,'topic'=>$topic]))
        ->with('success', 'Topic deleted');
        

    }
    public function trashed($classroom)
    {
        $topics = Topic::where('classroom_id', $classroom)->onlyTrashed()->get();
        return view('topics.trashed' ,compact('topics'));
    }

    public function restore($id)
    {
        // $topic = Topic::findOrFail($id);//هان رح يبحث عنه داخل الموجود بس مش عالمحدوف فلازم نحددله وين يبحث
        $topics = Topic::onlyTrashed()->findOrFail($id);
        $topics->restore();//بترجع حقل الحدف ل null
        return redirect(route('classroom.topic.index'))
            ->with('success', 'Topic ({$topic->name}) restored');
    }

    public function forceDelete($id)
    {
        $topic = Topic::withTrashed()->findOrFail($id);
        $topic->forceDelete();

        return redirect(route('topics.trashed'))
        ->with('success', 'Topic ({$topic->name}) restored');
    }
}
