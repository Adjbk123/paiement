@extends('layouts.app')

@section('title', 'Change Password')

@section('content')

<div class="py-5 tout">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                @if(session('message'))
                    <div class="alert alert-success mb-2">
                        <p>{{session('message')}}</p>
                    </div>
                @endif

                @if ($errors->any())
                <ul class="alert alert-warning ">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
                </ul>
                @endif
                <div class="card shadow">
                    <div class="card-header bg-primary">
                        <h4 class="mb-0 text-white">Change password 
                            <a href="{{url('profile')}}" class="btn btn-danger btn-sm float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                    <form action="" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="">Current passaword</label>
                            <input type="password" name="current_password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">New Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Confirm passaword</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-warning float-end">Update</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection