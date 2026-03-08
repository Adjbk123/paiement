@extends('layouts.admin')

@section('title', 'Gestion About')

@section('content')

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">
            <i class="fa fa-info-circle text-primary"></i> Gestion About
        </h3>

        <a href="{{ route('employer.gestabouts.abouts.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Ajouter
        </a>
    </div>

    @if($abouts->count() > 0)
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Sous titre</th>
                            <th>Titre</th>
                            <th>Description</th>
                            <th width="180">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($abouts as $about)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                @if($about->image_path)
                                    <img src="{{ asset($about->image_path) }}"
                                         class="rounded shadow-sm"
                                         width="70">
                                @else
                                    <span class="badge bg-secondary">Aucune</span>
                                @endif
                            </td>

                            <td>{{ $about->subtitle }}</td>

                            <td class="fw-semibold">
                                {{ Str::limit($about->title, 40) }}
                            </td>

                            <td>
                                {{ Str::limit($about->description, 60) }}
                            </td>

                            <td>

                                <a href="{{ route('employer.gestabouts.abouts.edit', $about) }}"
                                   class="btn btn-sm btn-warning">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <form action="{{ route('employer.gestabouts.abouts.destroy', $about) }}"
                                      method="POST"
                                      class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

            <div class="mt-3">
                {{ $abouts->links() }}
            </div>

        </div>
    </div>

    @else
        <div class="alert alert-info text-center">
            <i class="fa fa-info-circle"></i> Aucun enregistrement trouvé
        </div>
    @endif

</div>

@endsection

@section('scripts')

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    // Message succès
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Succès',
            text: "{{ session('success') }}",
            confirmButtonColor: '#3085d6'
        });
    @endif


    // Confirmation suppression
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {

            e.preventDefault();

            Swal.fire({
                title: 'Supprimer ?',
                text: "Cette action est irréversible",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui supprimer',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });

        });
    });

</script>

@endsection
