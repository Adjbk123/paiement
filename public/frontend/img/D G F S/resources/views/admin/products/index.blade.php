@extends('layouts.admin')

@section('content')
        @if (session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="card m-5 shadow">
            <div class="card-header">
                <h3>PRODUCTS
                    <a href="{{url('admin/products/create')}}" class="btn btn-primary btn-sm float-end">Add products</a>
                </h3>
            </div>
            <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <Th>Categories</Th>
                        <th>Productes</th>
                        <th>Prix</th>
                        <th>Quantite</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>
                                @if($product->category)
                                    {{$product->category->name}}
                                @else
                                    No Category
                                @endif
                            </td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->selling_price}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>{{$product->status == '1'? 'hidden':'visible'  }}</td>
                            <td>
                                <a href="{{url('admin/products/'.$product->id. '/edit')}}" class="btn btn-sm btn-success">Edit</a>
                                <a href="{{url('admin/products/'.$product->id. '/delete')}}" onclick="return confirm('vous etes sur de vouloir suprimer cette fichirer?')"  class="btn btn-sm btn-danger">Suprimer</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" >Pas De Produites Disponible</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div>
                {{$products->links()}}
            </div>
        </div>
        </div>
        
    </div>
</div>
@endsection















