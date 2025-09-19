<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Car Wash')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    @include('layout.navbar')

    <div class="container">
        @yield('content')
    </div>

    @include('layout.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("bookingForm");
            const paymentMethod = document.getElementById("paymentMethod");

            let metode = "Tunai";

            form.addEventListener("submit", function(e) {
                e.preventDefault();
                metode = paymentMethod.value;

                if (metode === "Tunai") {
                    simpanBooking(form, metode);
                } else {
                    let qrisModal = new bootstrap.Modal(document.getElementById('qrisModal'));
                    qrisModal.show();
                }
            });

            document.getElementById("btnSimulasiBayar").addEventListener("click", function() {
                simpanBooking(form, metode);
                let qrisModalEl = document.getElementById('qrisModal');
                bootstrap.Modal.getInstance(qrisModalEl).hide();
            });

            function simpanBooking(form, metode) {
                const formData = new FormData(form);

                fetch("{{ route('booking.store') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                        },
                        body: formData,
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            let successModal = new bootstrap.Modal(document.getElementById('successModal'));
                            successModal.show();
                        }
                })
                .catch(err => console.error(err));
            }
        });
    </script>
</body>

</html>
