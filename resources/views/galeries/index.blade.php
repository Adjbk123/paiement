@extends('layouts.admin')
@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="mb-0">Liste des Galeries</h3>
                <a href="{{ route('employer.gestgaleries.galeries.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nouvelle Galerie
                </a>
            </div>

            <table id="example1" class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Image</th>
                        <th>Titre</th>

                        <th>Type</th>
                        <th>Statut</th>
                        <th width="180">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($galeries as $galerie)
                        <tr>
                            <td>
                                @if($galerie->image)
                                    <img src="{{ asset($galerie->image) }}" width="80" height="60" style="object-fit:cover;">
                                @else
                                    <span class="text-muted">Aucune</span>
                                @endif
                            </td>
                            <td>{{ $galerie->title ?? '-' }}</td>

                            <td>
                                @if($galerie->type === 'societe')
                                    <span class="badge bg-info">Société</span>
                                @else
                                    <span class="badge bg-warning">Publicité</span>
                                @endif
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input toggle-statut"
                                           data-id="{{ $galerie->id }}"
                                           {{ $galerie->statut == 0 ? 'checked' : '' }}>
                                    <label class="form-check-label">
                                        {{ $galerie->statut == 0 ? 'Visible' : 'Invisible' }}
                                    </label>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('employer.gestgaleries.galeries.edit', $galerie->id) }}"
                                   class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <button onclick="supprimer({{ $galerie->id }})" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <form id="delete-form-{{ $galerie->id }}" method="POST"
                                      action="{{ route('employer.gestgaleries.galeries.destroy', $galerie->id) }}"
                                      style="display:none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $galeries->links() }}

        </div>
    </div>
</div>

{{-- SweetAlert2 et jQuery --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
function supprimer(id) {
    Swal.fire({
        title: 'Confirmer la suppression',
        text: 'Voulez-vous vraiment supprimer cette galerie ?',
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

$(document).on('change', '.toggle-statut', function() {

    let id = $(this).data('id');
    let checkbox = $(this);

    $.ajax({
        url: "/gestgaleries/toggle-statut/" + id, // ✅ correction ici
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}"
        },
        success: function(response) {

            if (response.success) {

                checkbox.next('label').text(response.label);

                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Statut mis à jour : ' + response.label,
                    showConfirmButton: false,
                    timer: 1500
                });

            }

        }
    });

});
</script>
@endsection
