@extends('layouts.admin')

@section('content')
    @if(session('message'))
        <div class="alert alert-success">{{session('message')}}</div>
    @endif

    <div class="card m-3 shadow">
        @if ($errors->any())
            <div class="alert alert-warning">
                @foreach($errors->all() as $error)
                    <div>{{$error}}</div>
                @endforeach
            </div>
        @endif
            <div class="card-header">
                <h3>
                    Add List
                    <a href="{{url('admin/sliders')}}" class="btn btn-danger btn-sm float-end text-light h6">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{url('admin/sliders/create')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description"  class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <input type="checkbox" name="statut">
                        check= hidden , un-check=Visible
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
    </div>

@endsection














