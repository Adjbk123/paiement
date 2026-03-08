@extends('layouts.admin')

@section('title', 'my oders')

@section('content')

                <div class="card m-4 shadow">
                    <div class="card-header">
                        <h3>Les Rappports</h3>
                    </div>
                    <div class="card-body">
                        <form action="">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">Filtrer Par Date</label>
                                    <input type="date" name="date" value="{{Request::get('date') ??  date('Y-m-d')}}" class="form-control"/>
                                </div>
                                <div class="col-md-3">
                                    <label>Filtrer par Status</label>
                                    <select name="status" class="form-select">
                                        <option value="">Selection Les Statuts</option>
                                        <option value="in progress {{Request::get('status') == 'in progress' ? 'selected':''}}">In Progress</option>
                                        <option value="completed {{Request::get('status') == 'completed' ? 'selected':''}}">Completed</option>
                                        <option value="pending {{Request::get('status') == 'pending' ? 'selected':''}}">Pending</option>
                                        <option value="cancelled {{Request::get('status') == 'cancelled' ? 'selected':''}}">cancelled</option>
                                        <option value="out-for-delivery {{Request::get('status') == 'out-for-delivery' ? 'selected':''}}">out for delivery</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <br>
                                    <button type="submit" class="btn btn-primary">Filtrer</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Id Des Commandes</th>
                                        <th>tracking No</th>
                                        <th>Nom D'utilisateurs</th>
                                        <th>Mode De Payement</th>
                                        <th>Date Des Commandes</th>
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
                                            <a href="{{url('admin/orders/'.$item->id)}}" class="btn btn-primary btn-sm">View</a>
                                        </td>
                                    </tr>
                                   @empty
                                    <tr>
                                        <td colspan="7">
                                            Pas De commandes Disponible Pour l'instant
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