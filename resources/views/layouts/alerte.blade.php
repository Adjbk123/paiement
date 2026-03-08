           <!-- Inclure SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // ✅ Message de succès
        @if(session('message'))
            Swal.fire({
                icon: 'message',
                title: 'Succès !',
                text: "{{ session('message') }}",
                timer: 3500,
                timerProgressBar: true,
                showConfirmButton: false,
            });
        @endif

        @if(session('status'))
            Swal.fire({
                icon: 'status',
                title: 'Succès !',
                text: "{{ session('status') }}",
                timer: 3500,
                timerProgressBar: true,
                showConfirmButton: false,
            });
        @endif

        // ⚠️ Message d'erreur général
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Erreur !',
                text: "{{ session('error') }}",
                timer: 4000,
                timerProgressBar: true,
                showConfirmButton: false,
            });
        @endif

        // ❌ Erreurs de validation
        @if ($errors->any())
            let errorMessages = '';
            @foreach ($errors->all() as $error)
                errorMessages += "• {{ $error }}\n";
            @endforeach

            Swal.fire({
                icon: 'error',
                title: 'Veuillez corriger les erreurs !',
                html: `<pre style="text-align:left;">${errorMessages}</pre>`,
                confirmButtonText: 'OK'
            });
        @endif
    });
</script>
