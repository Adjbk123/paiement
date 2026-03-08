@extends('layouts.app')

@section('title', 'New arrivals Products')

@section('content')

<div class="py-5 ">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>New arrivals Products</h4>
                <div class="underline1"></div>
                <div class="underline mb-5"></div>
            </div>
            @forelse($newArrivalsProducts as $productItem)
            <div class="col-md-3">
                <div class="product-card ">
                        <div class="product-card-img">
                            <label for="" class="stock bg-danger">New</label>
                            @if($productItem->productImages->count()>0)
                                <a href="{{url('/collections/'.$productItem->category->slug.'/'.$productItem->slug)}}">
                                    <img src="{{asset($productItem->productImages[0]->image)}}" alt="{{$productItem->name}}" class="img-fluid">
                                </a>
                            @endif
                        </div>
                        <div class="product-card-body">
                            <p class="product-brand">{{$productItem->brand}}</p>
                            <h5 class="product-name">
                                <a href="{{url('/collections/'.$productItem->category->slug.'/'.$productItem->slug)}}">{{$productItem->name}}</a>
                            </h5>
                            <div>
                                <span class="selling-price">{{$productItem->selling_price}} f cfa</span><br>
                                <span class="original-price">{{$productItem->original_price}} f cfa</span>
                            </div>
                            <div class="mt-2">
                            </div>
                        </div>
                    </div>
            </div>
            @empty
            <div class="p-2 col-md-12">
                <h4>{{$category->name}} non disponible </h4>
            </div>
            @endforelse

            <div class="text-center">
                <a href="{{url('collections')}}" class="btn btn-warning px-3">view More</a>
            </div>

        </div>
    </div>
</div>

@endsection