@extends('layouts.admin')
@section('title','Liste des Services')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Nos Services</h2>
        <a href="{{ route('employer.gestservices.services.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Nouveau Service
        </a>
    </div>

    <div class="row g-4">
        @forelse($services as $service)
            @php
                $features = is_array($service->features) ? $service->features : json_decode($service->features, true) ?? [];
            @endphp
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0 service-card">
                    @if($service->image_path)
                        <img src="{{ asset($service->image_path) }}" class="card-img-top" style="height:200px; object-fit:cover;">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $service->name }}</h5>
                        <p class="card-text">{!! html_entity_decode($service->description) !!}</p>

                        @if(!empty($features))
                            <ul class="list-unstyled mb-2">
                                @foreach($features as $feature)
                                    <li class="small"><i class="fa fa-check text-success me-1"></i>{{ $feature }}</li>
                                @endforeach
                            </ul>
                        @endif

                        @if($service->link)
                            <a href="{{ $service->link }}" target="_blank" class="btn btn-sm btn-outline-primary mb-2">Voir plus</a>
                        @endif

                        <div class="mt-auto d-flex justify-content-between">
                            <a href="{{ route('employer.gestservices.services.edit', $service->id) }}" class="btn btn-warning btn-sm">
                                <i class="fa fa-edit"></i> Editer
                            </a>

                            <button class="btn btn-danger btn-sm" onclick="deleteService({{ $service->id }})">
                                <i class="fa fa-trash"></i> Supprimer
                            </button>
                            <form id="delete-form-{{ $service->id }}" action="{{ route('employer.gestservices.services.destroy', $service->id) }}" method="POST" style="display:none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p>Aucun service disponible.</p>
        @endforelse
    </div>
</div>

{{-- SweetAlert2 et JS pour suppression --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function deleteService(id) {
    Swal.fire({
        title: 'Confirmer la suppression',
        text: 'Voulez-vous vraiment supprimer ce service ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Oui, supprimer'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>

{{-- CSS pour hover et modernité --}}
<style>
.service-card {
    transition: transform 0.3s, box-shadow 0.3s;
}
.service-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}
.card-title {
    font-weight: 600;
}
</style>
@endsection
