@extends('layouts.admin')

@section('title' , 'users List')

@section('content')

    @if (session('message'))
        <div class="alert alert-success">{{session('message')}}</div>
    @endif
    <div class="card m-3 shadow">
        <div class="card-header">
            <h3>Utilisateurs 
                <a href="{{url('admin/users/create')}}" class="btn btn-primary btn-sm float-end">Add User</a>
            </h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <Th>Nom</Th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @if($user->role_as == '0')
                                    <label for="" class="badge btn-primary">User</label>
                                @elseif($user->role_as == '1')
                                    <label for="" class="badge btn-warning">Admin</label>
                                @else
                                    <label for="" class="badge btn-danger">none</label>
                                @endif
                            </td>
                            <td>
                                <a href="{{url('admin/users/'.$user->id. '/edit')}}" class="btn btn-sm btn-success">Edit</a>
                                <a href="{{url('admin/users/'.$user->id. '/delete')}}" onclick="return confirm('vous etes sur de vouloir suprimer cette ficher ?')"  class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" >Vous ne Disposer pas d'utilisatrur Actuellement.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div>
                {{$users->links()}}
            </div>
        </div>
    </div>
        
@endsection