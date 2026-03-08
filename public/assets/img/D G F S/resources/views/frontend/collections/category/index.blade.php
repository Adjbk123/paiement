@extends('layouts.app')

@section('title', 'All category')

@section('content')

<div class="py-3 py-md-5 tout">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="mb-4">
                    Les Categories
                </h3>
                <hr>
            </div>
            @forelse($categories as $categoryItem)
                <div class="col-6 col-md-3 dom">
                    <div class="category-card">
                        <a href="{{url('/collections/'.$categoryItem->slug)}}">
                            <div class="category-card-img">
                                <img src="{{asset("$categoryItem->image")}}" alt="" class="img-fluid" style=" width: 100%;height: 250px;">
                            </div>
                            <div class="category-card-body">
                                <h5 class="text-success">{{$categoryItem->name}}</h5>
                            </div>
                        </a>
                    </div>
                </div>
                @empty
                    <div class="col-md-12">
                        <h5>Pas de Categories Valable</h5>
                    </div>
            @endforelse
        </div>
    </div>
</div>

@endsection












