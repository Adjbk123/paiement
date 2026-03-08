@extends('layouts.admin')

@section('title', 'my oders Details')

@section('content')
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
                @if(session('message'))
                <div class="alert alert-success mb-3">
                    {{session('message')}}
                </div>
                @endif
                <div class="card m-5 shadow">
                    <div class="card-header">
                        <h3>Details Des Commandes</h3>
                    </div>
                    <div class="card-body">
                    <div class="shadow bg-white p-3">
                        <h4 class="mb-4 text-primary">
                            <i class="fa fa-shopping-cart text-dark"></i>
                            My Orders Details
                            <a href="{{url('admin/orders')}}" class="btn btn-danger btn-sm float-end"><span class="fa fa-arrow-left"></span> Back</a>
                            <a href="{{url('admin/invoice/' .$order->id. '/generate')}}" class="btn btn-primary btn-sm float-end mx-2"><span class="fa fa-download"></span> Telecharger Le Recu</a>
                            <a href="{{url('admin/invoice/' .$order->id)}}" target="_blank" class="btn btn-warning btn-sm float-end"><span class="fa fa-eye"></span> Voir le Recu</a>
                           <a href="{{url('admin/invoice/' .$order->id.'/mail')}}" target="_blank" class="btn btn-info btn-sm float-end mx-2" ><span class="fa fa-envelope"></span> envoyer le recu  Via email</a>
                        </h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Details Des Commandes</h5>
                                <hr>
                                <h6>Order Id: {{$order->id}}</h6>
                                <h6>tracking Id/No. : {{$order->tracking_no}}</h6>
                                <h6>ordered Data: {{$order->created_at->format('d-m-Y h:i A')}}</h6>
                                <h6>Payment Mode: {{$order->payement_mode}} </h6>
                                <h6 class="border p-2 text-success">
                                    Order Status Message : <span class="text-uppercase">{{$order->status_message}}</span>
                                </h6>
                            </div>
                            <div class="col-md-6">
                                <h5>Details Utilisateurs</h5>
                                <hr>
                                <h6>Nom : {{$order->fullname}}</h6>
                                <h6>Mail: {{$order->email}}</h6>
                                <h6>Phone: {{$order->phone}}</h6>
                                <h6>Address: {{$order->address}}</h6>
                                <h6>Pin code: {{$order->pincode}}</h6>
                            </div>
                        </div>
                        <br/>
                        <h5>Order Item</h5>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Item ID</th>
                                        <th>image</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalPrice = 0;
                                    @endphp
                                   @foreach ($order->orderItems as $orderItem)
                                        <tr>
                                            <td width="10%">{{$orderItem->id}}</td>
                                            <td width="10%">
                                                @if($orderItem->product->productImages)
                                                    <img src="{{asset($orderItem->product->productImages[0]->image )}}" 
                                                    alt="" style="width:50px; height:50px;" />
                                                @else
                                                    <img src="" alt="" style="width:50px; height:50px;" />
                                                @endif
                                                    
                                            </td>
                                            <td >{{$orderItem->product->name}}</td>
                                            <td width="10%">{{$orderItem->price}} f cfa</td>
                                            <td width="10%">{{$orderItem->quantity}}</td>
                                            <td width="10%" class="fw-bold">{{$orderItem->quantity * $orderItem->price}} f cfa</td>
                                            @php
                                                $totalPrice += $orderItem->quantity * $orderItem->price;
                                            @endphp
                                        </tr>
                                   @endforeach 
                                   <tr>
                                       <td colspan="5" class="fw-bold">Total Amount:</td>
                                       <td colspan="1" class="fw-bold">{{$totalPrice}} f cfa</td>
                                   </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card border mt-3">
                    <div class="card-body">
                        <h4>Order Process (Order Status Update)</h4>
                        <hr>
                        <div class="col-md-5">
                            <form action="{{url('admin/orders/'.$order->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <label for="">Update Your Order Status</label>
                                <div class="input-group">
                                    <select name="order_status" id="" class="form-select">
                                    <option value="">Select Order Status</option>
                                        <option value="in progress {{Request::get('status') == 'in progress' ? 'selected':''}}">In Progress</option>
                                        <option value="completed {{Request::get('status') == 'completed' ? 'selected':''}}">Completed</option>
                                        <option value="pending {{Request::get('status') == 'pending' ? 'selected':''}}">Pending</option>
                                        <option value="cancelled {{Request::get('status') == 'cancelled' ? 'selected':''}}">cancelled</option>
                                        <option value="out-for-delivery {{Request::get('status') == 'out-for-delivery' ? 'selected':''}}">out for delivery</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary text-white">Update</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-7">
                            <br>
                            <h4 class="mt-3">Current Order Status: <span class="text-uppercase">{{$order->status_message}}</span></h4>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection