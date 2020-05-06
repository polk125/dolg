@extends('layouts.navbar')

@section('content')
<div class="card-body">
    <form action="{{url('classes/post')}}" method="POST" class="form-horizontal">
    {{csrf_field()}}
    <div class="row">
        <div class="form-group">
            <label for="Task" class="col-sm-3 control-label">Task </Label>
        <div class="row">
        <div class="col-sm-6">
            <input type="text" name="name" id="task-name" class="form-control">
        </div>
        <div class="col-sm-6">
            <button type="submit" class="btn btn-success"> <i class="fa fa-plus"></i> Add task</button>
        </div>
        </div>
        </div>
    </div>
    </form>
  </div>
  
  
  
    @if(count($tasks) > 0)
        <div class="card">
            <div class="card-heading">
                Current tasks
            </div>
            <div class="card-body">
                <table class="table table-striped task-table">
                <thead>
                <th>Task</th>
                <th>&nbsp;</th>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    <tr>
                    <td class="table-text">
                        <div>
                            
                            {{$task->number}}
                        </div>
                    </td>
                    <td>
                    <form action="{{url('classes/delete/'.$task->id)}}" method="POST">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button class="btn btn-danger">
                            Delete
                        </button>
                    </form>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
  
        </div>
    @endif

    
    @foreach($users as $user)
   
    <tr>
    <td class="table-text">
        {{print_r($user)}}
        <div>
            @foreach($user as $use)
            {{$use->number}}:
            {{$use->type}}
            @endforeach
        </div>
    </td>
    </tr>
    @endforeach
@endsection