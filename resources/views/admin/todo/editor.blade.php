@extends('layouts.admin.app')
@section('content')

<div class="main-content" style="min-height: 540px;">
    <section class="section">
      <div class="section-header">
        <div class="section-header-back">
          <a href="/todo" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>{{ $tittle }} To Do</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item">{{ $tittle }} To Do</div>
        </div>
      </div>

      <div class="section-body">
        <h2 class="section-title">{{ $tittle }} To Do</h2>
        <p class="section-lead">
          On this page you can {{ $tittle }} To Do and fill in all fields.
        </p>

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>{{ $tittle }} Your To Do</h4>
              </div>
              <form action="{{ $route }}" method="POST">
                @csrf
                @method($method)
              <div class="card-body">
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Task</label>
                  <div class="col-sm-12 col-md-7">
                    <input type="text" name="task" class="form-control" value="{{ @$todo->task }}">
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Assigned To</label>
                  <div class="col-sm-12 col-md-7">
                    <select class="form-control" name="assign">
                      <option>{{ @$todo->user->name }}</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{$user->name == $user->id  ? 'selected' : ''}}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                  </div>
                  
                </div>
                  <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Detail</label>
                    <div class="col-sm-12 col-md-7">
                      <textarea class="summernote-simple" name="detail"> {{ @$todo->detail }} </textarea>
                    </div>
                  </div>
                  <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Start Date</label>
                  <div class="col-sm-12 col-md-3">
                    <input type="date" class="form-control" name="start_date" value="{{ @$todo->start_date }}">
                  </div>  
                  </div> 
                  <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Due Date</label>
                  <div class="col-sm-12 col-md-3">
                    <input type="date" class="form-control" name="due_date" value="{{ @$todo->due_date }}">
                  </div>  
                  </div>       
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                  <div class="col-sm-12 col-md-7">
                    <button class="btn btn-primary">{{ $tittle }} To Do</button>
                  </div>
                </div>
              </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

@endsection

