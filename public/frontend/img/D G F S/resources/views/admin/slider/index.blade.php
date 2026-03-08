@extends('layouts.admin')

@section('content')

    @if(session('message'))
        <div class="alert alert-success">{{session('message')}}</div>
    @endif
    <div class="card m-2 shadow">
        <div class="card-header">
            <h3>
                Sliders List
                <a href="{{url('admin/sliders/create')}}" class="btn btn-primary btn-sm float-end text-light h6">Add sliders</a>
            </h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sliders as $slider)
                    <tr>
                        <td>{{$slider->id}}</td>
                        <td>{{$slider->title}}</td>
                        <td>{{$slider->description}}</td>
                        <td>
                            <img src="{{asset("$slider->image")}}" width="60px" height="60px"/>
                        </td>
                        <td>{{$slider->status == '0' ? 'visible': 'Hidden'}}</td>
                        <td>
                            <a href="#" class="btn btn-success">Edit</a>
                            <a href="#" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection














