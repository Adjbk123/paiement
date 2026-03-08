<?php

namespace App\Livewire;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Utilisateurs extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = "bootstrap";

    public $currentPage = PAGELIST;
    public $search = '';
    public $newUser = [];
    public $editUser = [];
    public $newPhoto;
    public $rolePermissions = [];
    public $confirmingUserId = null;

    protected $updatesQueryString = ['search'];

    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    // 🔍 Reset pagination si recherche
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $users = User::latest()
            ->when($this->search, function($query) {
                $query->where(function($q){
                    $q->where('name', 'like', '%'.$this->search.'%')
                      ->orWhere('email', 'like', '%'.$this->search.'%');
                });
            })
            ->paginate(10);

        return view('livewire.utilisateurs.index', compact('users'))
            ->extends('layouts.admin')
            ->section('content');
    }

    // ✅ Validation
    public function rules()
    {
        if ($this->currentPage == PAGEEDITFORM && isset($this->editUser['id'])) {
            return [
                'editUser.name'  => 'required|string|max:255',
                'editUser.email' => [
                    'required','email',
                    Rule::unique('users','email')->ignore($this->editUser['id'])
                ],
            ];
        }

        return [
            'newUser.name'  => 'required|string|max:255',
            'newUser.email' => 'required|email|unique:users,email',
        ];
    }

    // 🔁 Navigation
    public function goToAddUser()
    {
        $this->currentPage = PAGECREATEFORM;
        $this->reset(['newUser']);
    }

    public function goToEditUser($id)
    {
        $this->editUser = User::findOrFail($id)->toArray();
        $this->newPhoto = null;
        $this->currentPage = PAGEEDITFORM;
        $this->populateRolePermissions();
    }

    public function goToListUser()
    {
        $this->currentPage = PAGELIST;
        $this->reset(['editUser','newUser','newPhoto','confirmingUserId']);
        $this->resetPage();
    }

    // 🎭 Rôles & permissions
    public function populateRolePermissions()
    {
        $this->rolePermissions = ['roles' => [], 'permissions' => []];

        $user = User::findOrFail($this->editUser['id']);

        $roleIds = $user->roles->pluck('id')->toArray();
        $permissionIds = $user->permissions->pluck('id')->toArray();

        foreach (Role::all() as $role) {
            $this->rolePermissions['roles'][] = [
                'role_id' => $role->id,
                'role_nom' => $role->nom,
                'active' => in_array($role->id, $roleIds)
            ];
        }

        foreach (Permission::all() as $permission) {
            $this->rolePermissions['permissions'][] = [
                'permission_id' => $permission->id,
                'permission_nom' => $permission->nom,
                'active' => in_array($permission->id, $permissionIds)
            ];
        }
    }

    public function updateRoleAndPermissions()
    {
        $user = User::findOrFail($this->editUser['id']);

        $user->roles()->sync(
            collect($this->rolePermissions['roles'])->where('active', true)->pluck('role_id')
        );

        $user->permissions()->sync(
            collect($this->rolePermissions['permissions'])->where('active', true)->pluck('permission_id')
        );

        session()->flash('message', "Rôles et permissions mis à jour avec succès !");
        $this->goToListUser();
    }

    // ➕ Création utilisateur
    public function addUser()
    {
        $this->validate();

        $password = Str::random(8); // mot de passe aléatoire

        $photoPath = $this->newPhoto ? $this->newPhoto->store('users', 'public') : null;

        User::create([
            'name'     => $this->newUser['name'],
            'email'    => $this->newUser['email'],
            'password' => Hash::make($password),
            'photo'    => $photoPath,
        ]);

        session()->flash('message', "Utilisateur créé avec succès. Mot de passe : $password");
        $this->goToListUser();
    }

    // ✏️ Mise à jour utilisateur
    public function updateUser()
    {
        $this->validate();

        $user = User::findOrFail($this->editUser['id']);

        if ($this->newPhoto) {
            $user->photo = $this->newPhoto->store('users', 'public');
        }

        $user->update([
            'name'  => $this->editUser['name'],
            'email' => $this->editUser['email'],
        ]);

        session()->flash('message', "Utilisateur mis à jour avec succès");
        $this->goToListUser();
    }

    // ❌ Suppression sécurisée
    public function confirmDelete($id)
    {
        $this->confirmingUserId = $id;
    }

    public function deleteUser()
    {
        if ($this->confirmingUserId == Auth::id()) {
            session()->flash('message', "Vous ne pouvez pas supprimer votre propre compte !");
            return;
        }

        User::where('id', $this->confirmingUserId)->delete();

        session()->flash('message', "Utilisateur supprimé !");
        $this->goToListUser();
    }

    public function cancelDelete()
    {
        $this->confirmingUserId = null;
    }

    // 🔐 Changement mot de passe
    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|same:new_password_confirmation',
        ]);

        $user = Auth::user();

        if (!Hash::check($this->current_password, $user->password)) {
            $this->addError('current_password', 'Mot de passe actuel incorrect.');
            return;
        }

        $user->update([
            'password' => Hash::make($this->new_password)
        ]);

        session()->flash('message', 'Mot de passe mis à jour avec succès !');
        $this->reset(['current_password','new_password','new_password_confirmation']);
        $this->goToListUser();
    }
}
