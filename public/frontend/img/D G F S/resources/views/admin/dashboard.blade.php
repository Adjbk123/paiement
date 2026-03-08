@extends('layouts.admin')

@section('content')
<div class="container-fluid pt-4 px-4 ">
    <div class="row g-4">
      <div class="col-sm-6 col-xl-3">
          <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
              <i class="fa fa-chart-line fa-3x text-primary"></i>
              <div class="ms-3">
                  <p class="mb-2">TOTAL RECETTES HEBDOMANDAIRE</p>
                  <h6 class="mb-0"></h6>
              </div>
          </div>
      </div>
      <div class="col-sm-6 col-xl-3">
          <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
              <i class="fa fa-chart-bar fa-3x text-primary"></i>
              <div class="ms-3">
                  <p class="mb-2">TOTALE DEPENSES HEBDOMANDAIRE</p>
                  <h6 class="mb-0"></h6>
              </div>
          </div>
      </div>
      <div class="col-sm-6 col-xl-3">
          <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
              <i class="fa fa-chart-area fa-3x text-primary"></i>
              <div class="ms-3">
                  <p class="mb-2">TOTAL RECETTE ANNUEL</p>
                  <h6 class="mb-0"></h6>
              </div>
          </div>
      </div>
      <div class="col-sm-6 col-xl-3">
          <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
              <i class="fa fa-chart-pie fa-3x text-primary"></i>
              <div class="ms-3">
                  <p class="mb-2">TOTALE DEPENSES ANNUELLE</p>
                  <h6 class="mb-0"></h6>
              </div>
          </div>
      </div>
  </div>
</div>
<div class="container-fluid pt-4 px-4">
  <div class="row g-4">
      <div class="col-sm-12 col-xl-6">
          <div class="bg-light text-center rounded p-4">
              <div class="d-flex align-items-center justify-content-between mb-4">
                  <h6 class="mb-0">RECETTES</h6>
                  <a href="{{ url('admin/orders')}}">voir</a>
              </div>
              <canvas id="worldwide-sales"></canvas>
          </div>
      </div>
      <div class="col-sm-12 col-xl-6">
          <div class="bg-light text-center rounded p-4">
              <div class="d-flex align-items-center justify-content-between mb-4">
                  <h6 class="mb-0">DEPENSES</h6>
                  <a href="{{ url('admin/products')}}">Voir</a>
              </div>
              <canvas id="salse-revenue"></canvas>
          </div>
      </div>
  </div>
</div>
<div class="container-fluid pt-4 px-4">
  <div class="row g-4">
    <div class="col-sm-6 col-xl-3">
        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
            <i class="fa fa-shopping-bag fa-3x text-primary"></i>
            <div class="ms-3">
                <p class="mb-2">TOTAL ANNUEL RECETTE</p>
                <h6 class="mb-0"></h6>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
            <i class="fa fa-shopping-cart fa-3x text-primary"></i>
            <div class="ms-3">
                <p class="mb-2">TOTALE ANNUELE DEPENSES</p>
                <h6 class="mb-0"></h6>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
            <i class="fa fa-shopping-basket fa-3x text-primary"></i>
            <div class="ms-3">
                <p class="mb-2">Total </p>
                <h6 class="mb-0"></h6>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
            <i class="fa fa-id-card fa-3x text-primary"></i>
            <div class="ms-3">
                <p class="mb-2">Total Utilisateurs</p>
                <h6 class="mb-0">{{$totalAllUsers}}</h6>
            </div>
        </div>
    </div>
  </div>
</div>
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Recettes Annuel</h6>
                <canvas id="line-chart"></canvas>
            </div>
        </div>
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Depenses Annuelle</h6>
                <canvas id="bar-chart"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid pt-4 px-4 pb-4">
  <div class="row g-4">
    <div class="col-sm-6 col-xl-3">
        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
            <i class="fa fa-user-plus fa-3x text-primary"></i>
            <div class="ms-3">
                <p class="mb-2">Total Administrateurs</p>
                <h6 class="mb-0">{{$totalAdmin}}</h6>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
            <i class="fa fa-users fa-3x text-primary"></i>
            <div class="ms-3">
                <p class="mb-2">Total Utilisateurs Simples</p>
                <h6 class="mb-0">{{$totalUsers}}</h6>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
            <i class="fa fa-user fa-3x text-primary"></i>
            <div class="ms-3">
                <p class="mb-2">Utilisateurs Connecter</p>
                <h6 class="mb-0">{{$totalAllUsers}}</h6>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
            <i class="fa fa-bell fa-3x text-primary"></i>
            <div class="ms-3">
                <p class="mb-2">Total Des Notificatin</p>
                <h6 class="mb-0">123</h6>
            </div>
        </div>
    </div>
  </div>
</div>



@endsection


