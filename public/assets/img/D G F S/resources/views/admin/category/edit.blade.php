@extends('layouts.admin')

@section('content')

    <div class="p-4">
        <div class="card shadow">
            <div class="card-header">
                <h4><i class="fa fa-pen"></i> Modifier Les Categories
                    <a href="{{ url('admin/category')}}" class="btn btn-danger float-end btn-sm text-white"><i class="fa fa-arrow-left"></i>  Back</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{url('admin/category/'.$category->id)}}" method="POST" enctype="multipart/form-data" >

                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label>Nom</label>
                            <input type="text" name="name"value={{$category->name}}  class="form-control" />
                            @error('name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label>Limace</label>
                            <input type="text" name="slug"value={{$category->slug}} class="form-control" />
                            @error('slug')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-12">
                            <label>Description</label>
                            <textarea name="description"  rows="3" class="form-control">{{$category->description}}</textarea>
                            @error('description')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label>image</label>
                            <input type="file" name="image"  class="form-control" />
                            <img src="{{asset('/uploads/category/'.$category->image)}}" width="60px" height="60px">
                            @error('image')
                                <small class="text-danger">{{$message}}</small>
                            @enderror

                        </div>
                        <div class="mb-3 col-md-6">
                            <label>status</label><br/>
                            <input type="checkbox" name="status" {{$category->status == '1'? 'checked': ''}}/>
                        </div>
                        <div class="col-md-12">
                            <h4>SAO Tag</h4>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label>Titre</label>
                            <input type="text" name="meta_title"   class="form-control" value={{$category->meta_title}} />
                        </div>
                        <div class="mb-3 col-md-12">
                            <label>Mot Cle</label>
                            <textarea name="meta_keyword"  rows="3" class="form-control"> 
                                {{$category->meta_keyword}}</textarea>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label>Meta description </label>
                            <textarea name="meta_description"  rows="3" class="form-control">
                                {{$category->meta_description}}
                            </textarea>
                        </div>
                        <div class="mb-3 col-md-12">
                            <button class="btn btn-info float-end text-light" type="submit">Edith</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection



















