
@extends('layouts.admin')

@section('content')
 <div class="card m-3 shadow">
    <div class="card-header">
        <h3>Ajouter Des recettes 
            <a href="{{ url('admin/recette')}}" class="btn btn-danger btn-sm float-end"><i class="fa fa-arrow-left"></i> Back</a>
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
        <form action="{{url('admin/recette')}}" method="POST">
        @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="semaine" class="h6">Semaines</label>
                    <select name="semaine" id="semaine" class="form-select">
                        <option value="Select semaine">Select semaine</option>
                        <option value="1ère">1<sup>ère</sup> </option>
                        <option value="2ème">2<sup>ème</sup></option>
                        <option value="3ème">3<sup>ème</sup></option>
                        <option value="4ème">4<sup>ème</sup></option>
                        <option value="5ème">5<sup>ème</sup></option>
                    </select> 
                </div>
                <div class="col-md-6 mb-3">
                    <label for="" class="h6">Dimes</label>
                    <input type="text" name="dime" class="form-control">
                </div>
               
                <div class="col-md-6 mb-3">
                    <label for="" class="h6">Offrandes</label>
                    <input type="text" name="offrande" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="" class="h6">Offrandes Mardi</label>
                    <input type="text" name="offrande_m" class="form-control">
                </div>
                
            </div>
            <div class="row">
            <div class="col-md-6 mb-3">
                    <label for="" class="h6">Offrandes Jeudi</label>
                    <input type="text" name="offrande_j" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="" class="h6">Offrandes Special</label>
                    <input type="text" name="offrande_special" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="" class="h6">EDL</label>
                    <input type="text" name="edl" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="" class="h6">Action de Grace</label>
                    <input type="text" name="action_grace" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="" class="h6">DNAM</label>
                    <input type="text" name="dnam" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="" class="h6">Autres</label>
                    <input type="text" name="autre" class="form-control">
                </div>
                
                <div class="col-md-12 text-end">
                    <button type="submit" class="btn btn-primary">
                        Enregistrer
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection