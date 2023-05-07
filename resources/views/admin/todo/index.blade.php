@extends('layouts.admin.app')
@section ('content')

<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1> To Do List </h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
          <div class="breadcrumb-item">To Do</div>
        </div>
      </div>
      <div class="section-body">
        <h2 class="section-title">To Do List</h2>
        <p class="section-lead">
          You can manage all todos, such as editing, deleting and more.
        </p>
    
    <div class="card">
      <div class="card-header">
        <h4 class="d-inline">To Do List</h4>
        <div class="card-header-action">
          <a href="{{ $route }}" class="btn btn-primary">New To Do</a>
        </div>
      </div>
      @if(! count($todos))
    <tr>
        <td colspan="3">No todo</td>
    </tr>
    @endif
    @foreach($todos as $todo)
      <div class="card-body">             
        <ul class="list-unstyled list-unstyled-border">
          <li class="media">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" {{$todo->is_done ? 'checked' : ''}}>
              <input type ="hidden" name="id" value="{{ $todo->id }}">
            </div>
            <div class="media-body">
              @if($todo->is_done != 1)
              <div class="badge badge-pill badge-info mb-1 float-right">Not Complete</div>
              @elseif($todo->is_done != 0)
              <div class="badge badge-pill badge-success mb-1 float-right">Completed</div>
              @endif
              <h6 class="media-title"><a href="{{ route('todo.edit', $todo->id)}}">{{ $todo->task }}</a></h6>
              <div class="text-small text-muted">{{ $todo->user->name }} <div class="bullet"></div> <span class="text-primary">{{ $todo->start_date }} - {{ $todo->due_date}}</span></div>
                  <a href="#" onclick="event.preventDefault(); $('#destroy-{{ $todo->id }}').submit()" >Delete</a>
                  <form id="destroy-{{ $todo->id }}" action="{{ route('todo.destroy', $todo->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  </form>
              @if($todo->is_done == 1) 
                  <form action="{{ route('todo.completedUpdate', $todo->id) }}" method="POST">
                      @csrf                        
                      <button type="submit" class="btn btn-default" value="0">Mark as Not Complete</button>
                  </form>                    
              @else
                  <form action="{{ route('todo.completedUpdate', $todo->id) }}" method="POST">
                      @csrf                          
                      <button type="submit" class="btn btn-default" value="1">Mark as Complete</button>
                  </form>                                                 
              @endif  
            </div>
          </li>
        </ul>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection


