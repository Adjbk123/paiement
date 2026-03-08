@extends('layouts.admin')

@section('title' , 'users List')

@section('content')

    @if (session('message'))
        <div class="alert alert-success">{{session('message')}}</div>
    @endif

    @if ($errors->any())
        <ul class="alert alert-warning ">
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
    <div class="card m-3 shadow">
        <div class="card-header">
            <h3>Ajouter Des Utilisateurs 
                <a href="{{url('admin/users')}}" class="btn btn-danger btn-sm float-end"><i class="fa fa-arrow-left"></i> Back</a>
            </h3>
        </div>
        <div class="card-body">
            <form action="{{url('admin/users')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">Nom</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Email</label>
                        <input type="text" name="email" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Mot de passe </label>
                        <input type="text" name="password" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Select Role</label>
                        <select name="role_as" id="" class="form-select">
                            <option value="">Select Role</option>
                            <option value="0">User</option>
                            <option value="1">Admin</option>
                        </select> 
                    </div>
                    <div class="col-md-12 text-end">
                        <button type="submit" class="btn btn-primary">
                            Enregistrer
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
        
    

@endsection