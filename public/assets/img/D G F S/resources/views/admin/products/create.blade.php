@extends('layouts.admin')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <div class="card m-3 shadow">
        <div class="card-header">
            <h3>Ajouter Des Produts
                <a href="{{url('admin/products')}}" class="btn btn-danger btn-sm float-end">BACK</a>
            </h3>
        </div>
        <div class="card-body mt-3">
            @if ($errors->any())
            <div class="alert alert-warning">
                @foreach($errors->all() as $error)
                    <div>{{$error}}</div>
                @endforeach
            </div>
            @endif
            <form action="{{url('admin/products')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card p-3">
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
                    <div class="card-body">
                    <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="mb-3">
                            <label>Category</label></br>
                            <select name="category_id"  class="form-control">
                                @foreach($categories as $Category)
                                <option value="{{$Category->id}}">{{$Category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Product Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Product Slug</label>
                            <input type="text" name="slug" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Select Brand</label>
                            <select name="brand"  class="form-control">
                                @foreach($brands as $brand)
                                <option value="{{$brand->name}}">{{$brand->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Small Description (500 words)</label>
                            <textarea type="text" name="small_description" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>description</label>
                            <textarea  type="text" name="description" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-saotag" role="tabpanel" aria-labelledby="pills-saotag-tab">
                        <div class="mb-3">
                            <label>Meta Title</label>
                            <input type="text" name="meta_title" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Meta keyword </label>
                            <textarea type="text" name="meta_keyword" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Meta Description</label>
                            <textarea type="text" name="meta_description" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-details" role="tabpanel" aria-labelledby="pills-details-tab">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>0riginal Price</label>
                                    <input type="text" name="original_price" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>Selling Price</label>
                                    <input type="text" name="selling_price" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                            <div class="mb-3">
                                    <label>Quantity</label>
                                    <input type="number" name="quantity" class="form-control">
                                </div> 
                            </div>
                            <div class="col-md-4">
                            <div class="mb-3">
                                    <label>trending</label>
                                    <input type="checkbox" name="trending"  style="width:50px ; height:50px;">
                                </div> 
                            </div>
                            <div class="mb-3">
                                    <label>Featured</label>
                                    <input type="checkbox" name="featured"  style="width:50px ; height:50px;">
                                </div> 
                            </div>
                            <div class="col-md-4">
                            <div class="mb-3">
                                    <label>Status</label>
                                    <input type="checkbox" name="status"  style="width:50px ; height:50px;">
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-image" role="tabpanel"      aria-labelledby="pills-image-tab">
                        <div class="mb-">
                            <label>Upload Product Image</label>
                            <input type="file" name="image[]" multiple class="form-control">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mb-5 float-end">Submit</button>
                </div>
                
            </form>
        </div>
    </div>
        
@endsection















