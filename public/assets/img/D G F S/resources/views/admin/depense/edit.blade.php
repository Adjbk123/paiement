
@extends('layouts.admin')

@section('content')
 <div class="card m-3 shadow">
    <div class="card-header">
        <h3>Modifier Des Depenses 
            <a href="{{ url('admin/depense')}}" class="btn btn-danger btn-sm float-end"><i class="fa fa-arrow-left"></i> Back</a>
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
        <form action="{{url('admin/depense/'.$depense->id)}}" method="POST">
        @csrf
        @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="semaine" class="h6">Semaines</label>
                    <select name="semaine" id="semaine" class="form-select">
                        <option value="{{$depense->semaine}}">{{$depense->semaine}}</option>
                        <option value="1ère">1<sup>ère</sup> </option>
                        <option value="2ème">2<sup>ème</sup></option>
                        <option value="3ème">3<sup>ème</sup></option>
                        <option value="4ème">4<sup>ème</sup></option>
                        <option value="5ème">5<sup>ème</sup></option>
                        <option value="6ère">6<sup>ème</sup> </option>
                        <option value="7ème">7<sup>ème</sup></option>
                        <option value="8ème">8<sup>ème</sup></option>
                        <option value="9ème">9<sup>ème</sup></option>
                        <option value="10ème">10<sup>ème</sup></option>
                        <option value="11ème">11<sup>ème</sup></option>
                    </select> 
                </div>

                <div class="col-md-6 mb-3">
                    <label for="" class="h6">Salaire</label>
                    <input type="text" name="salaire" class="form-control" value="{{$depense->salaire}}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="" class="h6">Eau</label>
                    <input type="text" name="eau" class="form-control" value="{{$depense->eau}}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="" class="h6">Eletricité</label>
                    <input type="text" name="eletricite" class="form-control" value="{{$depense->eletricite}}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="" class="h6">Communication</label>
                    <input type="text" name="communication" class="form-control" value="{{$depense->communication}}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="" class="h6">Carburant</label>
                    <input type="text" name="carburant" class="form-control" value="{{$depense->carburant}}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="" class="h6">Deplacement</label>
                    <input type="text" name="deplacement" class="form-control" value="{{$depense->deplacement}}">
                </div>  
                <div class="col-md-6 mb-3">
                    <label for="" class="h6">Santé</label>
                    <input type="text" name="sante" class="form-control" value="{{$depense->sante}}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="" class="h6">Entretien</label>
                    <input type="text" name="entretien" class="form-control" value="{{$depense->entretien}}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="" class="h6">Fournitures</label>
                    <input type="text" name="fourniture" class="form-control" value="{{$depense->fourniture}}">
                </div>
                
            </div>
            <div class="row">
            <div class="col-md-6 mb-3">
                    <label for="" class="h6">Amortissement</label>
                    <input type="text" name="amotisement" class="form-control" value="{{$depense->amotisement}}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="" class="h6">20 %</label>
                    <input type="text" name="le_20" class="form-control" value="{{$depense->le_20}}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="" class="h6">15 %</label>
                    <input type="text" name="le_15" class="form-control" value="{{$depense->le_15}}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="" class="h6">Loyer</label>
                    <input type="text" name="loyer" class="form-control" value="{{$depense->loyer}}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="" class="h6">FAS</label>
                    <input type="text" name="fas" class="form-control" value="{{$depense->fas}}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="" class="h6">FOSPA</label>
                    <input type="text" name="fospa" class="form-control" value="{{$depense->fospa}}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="" class="h6">DNAM</label>
                    <input type="text" name="dnam" class="form-control" value="{{$depense->dnam}}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="" class="h6">Autres</label>
                    <input type="text" name="autre" class="form-control" value="{{$depense->autre}}">
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