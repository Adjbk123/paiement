@extends('layouts.admin')

@section('content')


        @if(session('message'))
            <h5 class="alert alert-success">{{(session('message'))}}</h5>
        @endif
 

        <div class="card m-2 shadow">
            <div class="card-header">
                <h3>Edit products
                    <a href="{{url('admin/products')}}" class="btn btn-danger btn-sm float-end"><i class="fa fa-arrow-left"></i> BACK</a>
                </h3>
            </div>
            <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-warning">
                @foreach($errors->all() as $error)
                    <div>{{$error}}</div>
                @endforeach
            </div>
            @endif
            <form action="{{url('admin/products/' .$product->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Home</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-saotag-tab" data-bs-toggle="pill" data-bs-target="#pills-saotag" type="button" role="tab" aria-controls="pills-saotag" aria-selected="false">SAO Tags</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-details-tab" data-bs-toggle="pill" data-bs-target="#pills-details" type="button" role="tab" aria-controls="pills-details" aria-selected="false">Details</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-image-tab" data-bs-toggle="pill" data-bs-target="#pills-image" type="button" role="tab" aria-controls="pills-image" aria-selected="false">Product Image</button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="mb-3">
                                <label>Categories</label>
                                <select name="category_id"  class="form-control">
                                    @foreach($categories as $Category)
                                    <option value="{{$Category->id}}" {{ $Category->id == $product->category_id ? 'selected': ''}} >
                                        {{$Category->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Product Nom</label>
                                <input type="text" name="name" value="{{$product->name}}"  class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Produtes limace</label>
                                <input type="text" name="slug" value="{{$product->slug}}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Selectionner La marque</label>
                                <select name="brand"  class="form-control">
                                    @foreach($brands as $brand)
                                    <option value="{{$brand->name}}" {{ $brand->id == $product->brand ? 'selected': ''}}>
                                        {{$brand->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Petite Description</label>
                                <textarea type="text" name="small_description" class="form-control" rows="4">{{$product->small_description}}</textarea>
                            </div>
                            <div class="mb-3">
                                <label>description</label>
                                <textarea  type="text" name="description" class="form-control" rows="4">{{$product->description}}</textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-saotag" role="tabpanel" aria-labelledby="pills-saotag-tab">
                            <div class="mb-3">
                                <label>Titre</label>
                                <input type="text" name="meta_title" class="form-control" value="{{$product->meta_title}}">
                            </div>
                            <div class="mb-3">
                                <label>mots cles </label>
                                <textarea type="text" name="meta_keyword" class="form-control" rows="4">{{$product->meta_keyword}}</textarea>
                            </div>
                            <div class="mb-3">
                                <label>Meta Description</label>
                                <textarea type="text" name="meta_description" class="form-control" rows="4">
                                    {{$product->meta_description}}
                                </textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-details" role="tabpanel" aria-labelledby="pills-details-tab">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Original Prix</label>
                                        <input type="text" name="original_price" class="form-control" value="{{$product->original_price}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Prix reduite</label>
                                        <input type="text" name="selling_price" class="form-control" value="{{$product->selling_price}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                <div class="mb-3">
                                        <label>Quantite</label>
                                        <input type="number" name="quantity" class="form-control" value="{{$product->quantity}}">
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>trending</label>
                                        <input type="checkbox" name="trending"  style="width:50px ; height:50px;"{{$product->trending == '1' ? 'checked': ''}}>
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Featured</label>
                                        <input type="checkbox" name="featured"  style="width:50px ; height:50px;"{{$product->featured == '1' ? 'checked': ''}}>
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                <div class="mb-3">
                                        <label>Status</label>
                                        <input type="checkbox" name="status"  style="width:40px ; height:40px;" {{$product->status == '1' ? 'checked': ''}}>
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-image" role="tabpanel" aria-labelledby="pills-image-tab">
                            <div class="mb-3">
                                <label>Upload Product Image</label>
                                <input type="file" name="image[]" multiple class="form-control">
                            </div>
                            <div>
                                @if(@$product->productImages)
                                    <div class="row">
                                        @foreach (@$product->productImages as $image)
                                            <div class="col-md-2">
                                                <img src="{{asset($image->image)}}" alt="img" class="me-4 border" style="width:80px; height:80px;"/>
                                            <a href="{{url('admin/product-image/' .$image->id. '/delete')}}" class="d-block">Suprimer</a> 
                                            </div>    
                                        @endforeach
                                    </div>
                                @else
                                <h5>Pas d'Image</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <button type="submit" class="btn btn-primary mb-5 mt-3 float-end">Submit</button>
            </form>
        </div>
        
        </div>
</div>
@endsection















