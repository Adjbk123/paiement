<div class="row p-3 p-md-4 pt-5 justify-content-center">
    <div class="col-12 col-sm-12 col-md-12">
        <div class="card card-primary shadow-sm">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title">
                    <i class="fas fa-user-plus fa-2x"></i> Formulaire de création d'un nouvel Utilisateur
                </h3>
            </div>

            <form role="form" wire:submit.prevent="addUser" enctype="multipart/form-data">
                <div class="card-body">

                    {{-- Nom --}}
                    <div class="form-group mb-3">
                        <label for="">Nom</label>
                        <input type="text" wire:model="newUser.name" 
                               class="form-control @error('newUser.name') is-invalid @enderror">
                        @error('newUser.name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="form-group mb-3">
                        <label for="">Adresse e-mail</label>
                        <input type="email" wire:model="newUser.email" 
                               class="form-control @error('newUser.email') is-invalid @enderror">
                        @error('newUser.email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Mot de passe --}}
                    <div class="form-group mb-3">
                        <label for="">Mot de passe <span class="text-danger">(par défaut: azertyui)</span></label>
                        <input type="password" class="form-control" placeholder="Password (par défaut: azertyui)">
                    </div>

                </div>

                <div class="card-footer d-flex flex-column flex-sm-row justify-content-between gap-2">
                    <button type="submit" class="btn btn-primary flex-fill">Enregistrer</button>
                    <button type="button" wire:click="goToListUser" class="btn btn-danger flex-fill">Retourner à la liste des utilisateurs</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Petite ombre pour le card et bord arrondi */
.card-primary {
    border-radius: 12px;
}

/* Responsive spacing sur mobile */
@media (max-width: 576px) {
    .card-body input.form-control {
        font-size: 0.95rem;
    }
    .card-footer button {
        width: 100%;
    }
}
</style>
