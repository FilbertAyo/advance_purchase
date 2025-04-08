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
            toastr.success("{{ session('success') }}", "Done", {
                    positionClass: "toast-top-right",
                    timeOut: 5e3,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    progressBar: !0,
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1
                })

        });
    </script>
@elseif (session('error'))
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            toastr.error("{{ session('error') }}", "Error!", {
                    positionClass: "toast-top-right",
                    timeOut: 5e3,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    progressBar: !0,
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1
                })

        });
    </script>
@endif


@if ($errors->any())

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}", "Error!", {
                    positionClass: "toast-top-right",
                    timeOut: 5e3,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    progressBar: !0,
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1
                });
                @endforeach

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


<link rel="stylesheet" href="{{ asset('toastr/css/toastr.min.css') }}">

<script src="{{ asset('toastr/global.min.js') }}"></script>
<script src="{{ asset('toastr/quixnav-init.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script src="{{ asset('toastr/toastr-init.js') }}"></script>
