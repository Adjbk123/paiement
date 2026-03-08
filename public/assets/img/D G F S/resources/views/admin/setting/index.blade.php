@extends('layouts.admin')

@section('content')

@section('title' , 'Admin setting')

<div class="row m-3">
    <div class="col-md-12 grid-margin">
        @if(session('message'))
            <div class="alert alert-success mb-3">
                {{session('message')}}
            </div>
        @endif
        <form action="{{url('admin/settings')}}" method="POST">
            @csrf

            <div class="card mb-3">
                <div class="card-header bg-primary">
                    <h3 class="text-white mb-0">Website</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">website Name</label>
                            <input type="text" name="website_name" value="{{$setting->website_name ?? ''}}" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">website URL</label>
                            <input type="text" name="website_url" value="{{$setting->website_url ?? ''}}" class="form-control">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Page Title</label>
                            <input type="text" name="title" value="{{$setting->title ?? ''}}" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Meta Keywords</label>
                            <textarea type="text" name="meta_keywords"  class="form-control" rows="3">{{$setting->meta_keywords ?? ''}}</textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Meta Description</label>
                            <textarea type="text" name="meta_description"  class="form-control" rows="3">{{$setting->meta_description ?? ''}}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header bg-primary">
                    <h3 class="text-white mb-0">website - Information</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="">Addresss</label>
                            <textarea name="address" id=""  rows="3"   class="form-control">{{$setting->address ?? ''}}</textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Phone 1 *</label>
                            <input type="text" name= "phone1" value="{{$setting->phone1 ?? ''}}" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Phone 2 *</label>
                            <input type="text" name= "phone2" value="{{$setting->phone2 ?? ''}}" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Email 1 *</label>
                            <input type="text" name= "email1" value="{{$setting->email1 ?? ''}}" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Email 2 *</label>
                            <input type="text" name= "email2" value="{{$setting->email2 ?? ''}}" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header bg-primary">
                    <h3 class="text-white mb-0">website - Social Media</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Facebook (Optional)</label>
                            <input type="text " name="facebook" value="{{$setting->facebook ?? ''}}" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Twitter (Optional)</label>
                            <input type="text " name="twitter" value="{{$setting->twitter ?? ''}}" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Instagram (Optional)</label>
                            <input type="text " name="instagram" value="{{$setting->instagram ?? ''}}" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">youtube (Optional)</label>
                            <input type="text " name="youtube" value="{{$setting->youtube ?? ''}}" class="form-control">
                        </div>
                    </div>  
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary text-white"> Save  Setting</button>
            </div>

        </form>
    </div>
</div>
@endsection