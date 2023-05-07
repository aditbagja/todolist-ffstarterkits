<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'tittle' => 'List Todo',
            'todos' => Todo::get(),
            'route' => route('todo.create'),
            'todos' => Todo::orderBy('created_at','desc')->paginate(100),
        ];
        return view('admin.todo.index', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = [
            'tittle' => 'Create New',
            'method' => 'POST',
            'users' => User::get(),
            'route' => route('todo.store'),
    ];
        
        return view('admin.todo.editor', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $todo = new Todo;
        $user_id = Auth()->user()->id;

        $todo->task = $request->task;
        $todo->user_id = $user_id;
        $todo->detail = $request->detail;
        $todo->start_date = $request->start_date;
        $todo->due_date = $request->due_date;
        $todo->save();

        return redirect(route("todo.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($task)
    {
        $data = [
            'tittle' => 'List',
            'todo' => Todo::where('slug', $task)->first(),
    ]; 
        return view('todo', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'tittle' => 'Edit',
            'method' => 'PUT',
            'users' => User::get(),
            'route' => route('todo.update', $id),
            'todo' => Todo::where('id', $id)->first()
    ];
        return view('admin.todo.editor', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $todo = Todo::find($id);
        $user_id = Auth()->user()->id;

        $todo->task = $request->task;
        $todo->user_id = $user_id;
        $todo->detail = $request->detail;
        $todo->start_date = $request->start_date;
        $todo->due_date = $request->due_date;
        $todo->update();

        return redirect(route("todo.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Todo::where('id', $id);
        $destroy -> delete();
        return redirect(route("todo.index"));
    }
    
    /**
     * Summary of completedUpdate
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function completedUpdate(Request $request, $id){
        $todo = Todo::findOrFail($id);
        $todo->update(['is_done' => ! $todo->is_done]);
   
    return redirect(route('todo.index'));
}


}