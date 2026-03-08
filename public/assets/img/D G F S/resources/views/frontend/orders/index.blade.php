@extends('layouts.app')

@section('title', 'my oders')

@section('content')

    <div class="py-3 py-md-5 tout">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4 class="mb-4">Mes Commandes</h4>
                        <hr>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Id Commande</th>
                                        <th>tracking No</th>
                                        <th>Nom utilisateur</th>
                                        <th>Payement Mode</th>
                                        <th>Date Commande</th>
                                        <th>Status message</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @forelse ($orders as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->tracking_no}}</td>
                                        <td>{{$item->fullname}}</td>
                                        <td>{{$item->payement_mode}}</td>
                                        <td>{{$item->created_at->format('d-m-Y')}}</td>
                                        <td>{{$item->status_message}}</td>
                                        <td>
                                            <a href="{{url('orders/'.$item->id)}}" class="btn btn-primary btn-sm">View</a>
                                        </td>
                                    </tr>
                                   @empty
                                    <tr>
                                        <td colspan="7">
                                            Vous n'avez Rien Commandé Pour Le Momment
                                        </td>
                                    </tr>
                                   @endforelse 
                                </tbody>
                            </table>
                        </div>
                        <div>
                            {{$orders->links()}}
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection