<div wire:ignore.self>

    @if($currentPage == PAGECREATEFORM)
         @include("livewire.utilisateurs.create")
    @endif

    @if($currentPage == PAGEEDITFORM)
        @include("livewire.utilisateurs.edit")
    @endif

    @if($currentPage == PAGELIST)
        @include("livewire.utilisateurs.liste")
    @endif

</div>

<script>
    Livewire.on("showSuccessMessage", data => {
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            toast: true,
            title: data.message || "Opération effectuée avec succès !",
            showConfirmButton: false,
            timer: 5000
        });
    });

    Livewire.on("showConfirmMessage", message => {
        Swal.fire({
            title: message.title,
            text: message.text,
            icon: message.type,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Continuer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                if (message.data && message.data.user_id) {
                    Livewire.dispatch('deleteUser', message.data.user_id);
                }
                Livewire.dispatch('resetPassword');
            }
        });
    });
</script>
