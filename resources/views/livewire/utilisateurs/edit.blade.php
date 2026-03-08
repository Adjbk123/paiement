<div class="row p-4 pt-5">
    <!-- Formulaire infos utilisateur -->
    <div class="col-md-6 mb-4">
        <div class="card card-primary shadow-sm">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user-plus fa-2x"></i> Formulaire d'édition utilisateur
                </h3>
            </div>

            <form role="form" wire:submit.prevent="updateUser" enctype="multipart/form-data">
                <div class="card-body">

                    {{-- Nom --}}
                    <div class="form-group">
                        <label for="">Nom</label>
                        <input type="text" wire:model="editUser.name" 
                               class="form-control @error('editUser.name') is-invalid @enderror">
                        @error('editUser.name')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="form-group">
                        <label for="">Adresse e-mail</label>
                        <input type="email" wire:model="editUser.email" 
                               class="form-control @error('editUser.email') is-invalid @enderror">
                        @error('editUser.email')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="card-footer d-flex flex-column flex-sm-row gap-2">
                    <button type="submit" class="btn btn-primary flex-fill">Appliquer la Modification</button>
                    <button type="button" wire:click="goToListUser" class="btn btn-danger flex-fill">Retour à la liste</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Mot de passe & rôles -->
    <div class="col-md-6 mb-4">
        <div class="row">

            {{-- Reset password --}}
            <div class="col-12 mb-4">
                <div class="card card-primary shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-key fa-2x"></i> Réinitialisation de mot de passe
                        </h3>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="updatePassword">
                            <div class="mb-3">
                                <label class="form-label">Mot de passe actuel</label>
                                <input type="password" class="form-control" wire:model="current_password">
                                @error('current_password') 
                                    <span class="text-danger small">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nouveau mot de passe</label>
                                <input type="password" class="form-control" wire:model="new_password">
                                @error('new_password') 
                                    <span class="text-danger small">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Confirmer le nouveau mot de passe</label>
                                <input type="password" class="form-control" wire:model="new_password_confirmation">
                            </div>

                            <div class="text-end">
                                <button class="btn btn-success" type="submit">
                                    <i class="fas fa-check"></i> Changer le mot de passe
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Roles & permissions --}}
            <div class="col-12">
                <div class="card card-primary shadow-sm">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="card-title flex-grow-1">
                            <i class="fas fa-fingerprint fa-2x"></i> Roles & permissions
                        </h3>
                        <button class="btn bg-gradient-success" wire:click="updateRoleAndPermissions">
                            <i class="fas fa-check"></i> Appliquer
                        </button>
                    </div>

                    <div class="card-body">
                        <div id="accordion">
                            @foreach($rolePermissions["roles"] as $role)
                                <div class="card mb-2">
                                    <div class="card-header d-flex justify-content-between">
                                        <h4 class="card-title flex-grow-1">
                                            <a href="#">{{ $role["role_nom"] }}</a>
                                        </h4>
                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input type="checkbox" class="custom-control-input"
                                                   id="roleSwitch{{ $role['role_id'] }}"
                                                   wire:model.lazy="rolePermissions.roles.{{ $loop->index }}.active">
                                            <label class="custom-control-label" for="roleSwitch{{ $role['role_id'] }}">
                                                {{ $role["active"] ? "Activé" : "Désactivé" }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="p-3 table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Permissions</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rolePermissions["permissions"] as $permission)
                                    <tr>
                                        <td>{{ $permission["permission_nom"] }}</td>
                                        <td>
                                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                <input type="checkbox" class="custom-control-input"
                                                       id="permSwitch{{ $permission['permission_id'] }}"
                                                       wire:model.lazy="rolePermissions.permissions.{{ $loop->index }}.active">
                                                <label class="custom-control-label" for="permSwitch{{ $permission['permission_id'] }}">
                                                    {{ $permission["active"] ? "Activé" : "Désactivé" }}
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<style>
.card {
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}

.card-header {
    font-weight: bold;
    font-size: 1.1rem;
}

.form-group label,
.form-label {
    font-weight: 500;
}
</style>
