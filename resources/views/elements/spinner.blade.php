<style>
    #spinner-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: white;
        /* Semi-transparent overlay */
        z-index: 1000;
        display: flex;
        justify-content: center;
        align-items: center;
        /* Center the spinner */
    }
</style>


<div id="spinner-overlay"
    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.2); z-index: 1000; justify-content: center; align-items: center;">

    <div class="bg-white p-3">
        <div class="spinner-border spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        </div>
    </div>
</div>


@if (session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Swal.fire({
                position: "center",
                icon: "success",
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>
@elseif (session('error'))
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Swal.fire({
                position: "center",
                icon: "error",
                title: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>
@endif


@if ($errors->any())
   
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Swal.fire({
                position: "center",
                icon: "error",
                title: "Validation Error",
                html: `
                    <ul style="text-align: left; list-style: none; padding: 0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                `,
                showConfirmButton: true
            });
        });
    </script>
@endif


<script>
    function reloadPage() {
        location.reload();
    }
</script>

<script>
    // Show the spinner before the page is refreshed
    window.addEventListener('beforeunload', function() {
        // Display the spinner overlay
        document.getElementById('spinner-overlay').style.display = 'flex';
    });
</script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.body.addEventListener("click", function (event) {
            if (event.target.matches(".permission-alert")) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "You don't have permission to perform this action!",
                });
            }
        });
    });
</script>


{{-- delete --}}
<script>
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success ml-2", // Added 'ml-2' for spacing
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });

    function showSweetAlert(event, itemId) {
        event.preventDefault(); // Prevent the form from submitting immediately

        swalWithBootstrapButtons.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form programmatically
                document.getElementById(`deleteForm-${itemId}`).submit();
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: "Cancelled",
                    text: "Your application is safe :)",
                    icon: "error"
                });
            }
        });

        return false; // Prevent default form submission behavior
    }
</script>

