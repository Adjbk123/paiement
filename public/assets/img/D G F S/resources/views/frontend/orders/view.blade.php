@extends('layouts.app')

@section('title', 'my oders Details')

@section('content')

    <div class="py-3 py-md-5 tout">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4 class="mb-4 text-primary">
                            <i class="fa fa-shopping-cart text-dark"></i>
                            Les Details De Mes Commandes
                            <a href="{{url('orders')}}" class="btn btn-danger btn-sm float-end">Back</a>
                        </h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Details Du Commandes</h5>
                                <hr>
                                <h6>Id Du commande: {{$order->id}}</h6>
                                <h6>tracking Id/No. : {{$order->tracking_no}}</h6>
                                <h6>Date Du Commande: {{$order->created_at->format('d-m-Y h:i A')}}</h6>
                                <h6>Payment Mode: {{$order->payement_mode}} </h6>
                                <h6 class="border p-2 text-success">
                                    Order Status Message : <span class="text-uppercase">{{$order->status_message}}</span>
                                </h6>
                            </div>
                            <div class="col-md-6">
                                <h5>Information De L'utilisateur</h5>
                                <hr>
                                <h6>Nom Complet : {{$order->fullname}}</h6>
                                <h6>Email Id: {{$order->email}}</h6>
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
                                        <th>Prix</th>
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
                                       <td colspan="5" class="fw-bold">Total :</td>
                                       <td colspan="1" class="fw-bold">{{$totalPrice}} f cfa</td>
                                   </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection