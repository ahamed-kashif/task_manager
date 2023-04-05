<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;


class TasksController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:web']);
    }

    public function store(TaskRequest $request){
        try{
            $task = Project::findOrFail($request->project_id)->tasks()->create(array_merge($request->only(['title','description']),['slug' => \Illuminate\Support\Str::slug($request->title)]));
            $task->update([
                'priority' => $task->id
            ]);
            return redirect()->route('dashboard')->with([
                'success' => 'Task added'
            ]);
        }catch (\Exception $e){
            return redirect()->back()->with([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function edit($slug){
        try{
            $task = Task::where('slug',$slug)->firstOrFail();
            return view('tasks.edit')->with([
                'title' => 'Edit Task',
                'task' => $task,
                'projects' => Project::orderBy('created_at','desc')->get()
            ]);
        }catch (\Exception $e){
            return redirect()->route('dashboard')->with([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function update($slug, Request $request){
        $request->validate([
            'title' => 'required'
        ]);
        try{
            $task = Task::where('slug',$slug)->firstOrFail();
            $task->update(array_merge($request->only(['title','description']),['slug' => \Illuminate\Support\Str::slug($request->title)]));
            return redirect()->route('dashboard')->with([
                'success' => 'Task updated'
            ]);
        }catch (\Exception $e){
            return redirect()->back()->with([
                'error' => $e->getMessage()
            ]);
        }
    }
    public function delete($slug){
        try{
            $task = Task::where('slug',$slug)->firstOrFail();
            $task->delete();
            return redirect()->route('dashboard')->with([
                'success' => 'Task removed'
            ]);
        }catch (\Exception $e){
            return redirect()->back()->with([
                'error' => $e->getMessage()
            ]);
        }
    }
}
