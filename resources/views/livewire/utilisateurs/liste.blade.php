<div class="row p-4 pt-5">
    <div class="col-12">

        {{-- Messages de session --}}
        @if (session()->has('message'))
            <div class="alert alert-success text-center">{{ session('message') }}</div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @endif

        <div class="card shadow-sm">
            <div class="card-header bg-gradient-primary d-flex flex-column flex-md-row align-items-center justify-content-between gap-2">

    {{-- Titre --}}
    <h3 class="card-title d-flex align-items-center gap-2 mb-2 mb-md-0">
        <i class="fas fa-users fa-2x"></i> Liste des utilisateurs
    </h3>

    {{-- Bouton Ajouter + Recherche --}}
    <div class="d-flex align-items-center gap-2 ms-md-auto">

        {{-- Bouton Ajouter utilisateur --}}
       

        
{{--<button class="btn btn-light btn-sm"
                wire:click="goToAddUser">
            <i class="fas fa-plus-circle"></i> Ajouter utilisateur
        </button> --}}
    </div>
</div>

            {{-- Corps de la table --}}
            <div class="card-body table-responsive p-0" style="max-height: 400px;">
                <table class="table table-head-fixed table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th style="width:20%;">Utilisateurs</th>
                            <th style="width:15%;">Rôles</th>
                            <th style="width:15%;" class="text-center">Ajouté</th>
                            <th style="width:25%;" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->allRoleNames }}</td>
                            <td class="text-center">
                                <span class="badge badge-success">{{ $user->created_at->diffForHumans() }}</span>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary" wire:click="goToEditUser({{ $user->id }})" title="Modifier">
                                    <i class="far fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" wire:click="confirmDelete({{ $user->id }})" title="Supprimer">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-danger">
                                Aucun utilisateur trouvé pour : <strong>{{ $search }}</strong>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="card-footer d-flex justify-content-center">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>

{{-- Modal de confirmation Livewire --}}
@if($confirmingUserId)
<div class="modal fade show d-block" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-header">
                <h5 class="modal-title">Confirmer la suppression</h5>
            </div>
            <div class="modal-body">
                <p class="mb-0">Êtes-vous sûr de vouloir supprimer cet utilisateur ?</p>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button class="btn btn-secondary flex-fill" wire:click="cancelDelete">Annuler</button>
                <button class="btn btn-danger flex-fill" wire:click="deleteUser">Supprimer</button>
            </div>
        </div>
    </div>
</div>
<div class="modal-backdrop fade show"></div>

@endif
