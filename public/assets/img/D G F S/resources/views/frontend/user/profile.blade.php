@extends('layouts.app')

@section('title', 'user Profile')

@section('content')

<div class="py-5 tout">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @if(session('message'))
                    <div class="alert alert-success">
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
                <h4>User profile
                   <a href="{{url('change-password')}}" class="btn btn-warning float-end">Change Password ?</a> 
                </h4>
                <div class="underline1"></div>
                <div class="underline mb-5"></div>
            </div>
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-header bg-primary">
                        <h4 class="mb-0 text-white">
                            User Datails
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{url('profile')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="">Username</label>
                                        <input type="text" class="form-control" name="username" value="{{Auth::user()->name}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="">User Email</label>
                                        <input type="text" class="form-control" readonly value="{{Auth::user()->email}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="">Phone number</label>
                                        <input type="text" class="form-control" name="phone" value="{{Auth::user()->userDetail->phone ?? ''}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="">Zip Code</label>
                                        <input type="text" class="form-control" name="pin_code" value="{{Auth::user()->userDetail->pin_code ?? ''}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="">Address</label>
                                        <textarea name="address" id=""  rows="3" class="form-control">{{Auth::user()->userDetail->address ?? ''}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary float-end">Save Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection