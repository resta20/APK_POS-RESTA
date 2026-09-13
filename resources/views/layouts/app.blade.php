<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>restathrift - @yield('title')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Retro pastel theme fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500;600;700&family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #fdf8f0;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Fredoka', sans-serif;
        }
        .alert-success {
            background-color: #f1efec;
            border: none;
            border-left: 3px solid #a8a29a;
            border-radius: 0 6px 6px 0;
            color: #4a3f35;
        }
        .alert-danger {
            background-color: #fbeaea;
            border-color: #b98a8f;
            color: #4a3f35;
        }

        .swal2-popup {
            font-family: 'Nunito', sans-serif !important;
            border-radius: 16px !important;
            background-color: #fdf8f0 !important;
        }
        .swal2-title {
            font-family: 'Fredoka', sans-serif !important;
            color: #4a3f35 !important;
        }
        .swal2-html-container {
            color: #8a7d72 !important;
        }
        .swal-confirm-btn {
            background-color: #b98a8f !important;
            color: #fdf8f0 !important;
            border-radius: 20px !important;
            font-weight: 600 !important;
            padding: 8px 24px !important;
            box-shadow: none !important;
        }
        .swal-confirm-btn:hover {
            background-color: #a3767b !important;
        }
        .swal-cancel-btn {
            background-color: #ece4dd !important;
            color: #4a3f35 !important;
            border-radius: 20px !important;
            font-weight: 600 !important;
            padding: 8px 24px !important;
            box-shadow: none !important;
        }
        .swal-cancel-btn:hover {
            background-color: #ddd2c7 !important;
        }
    </style>
</head>
<body>

@auth
    @include('layouts.navbar')
@endauth

<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @yield('content')
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- html2canvas: untuk fitur cetak/simpan struk sebagai gambar -->
<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>

<script>
    document.addEventListener('submit', function (e) {
        const form = e.target.closest('.js-confirm-delete');
        if (!form) return;

        e.preventDefault();

        const title = form.dataset.confirmTitle || 'Yakin hapus?';
        const text = form.dataset.confirmText || 'Data yang sudah dihapus tidak bisa dikembalikan.';

        Swal.fire({
            title: title,
            text: text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            customClass: {
                confirmButton: 'swal-confirm-btn',
                cancelButton: 'swal-cancel-btn'
            },
            buttonsStyling: false,
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    // Cetak / simpan struk sebagai gambar (event delegation, aman dipakai di modal fetch)
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.btn-cetak-struk');
        if (!btn) return;

        const struk = document.getElementById(btn.dataset.target);
        if (!struk) return;

        html2canvas(struk, {
            backgroundColor: '#fffdfa',
            scale: 2
        }).then(function (canvas) {
            const link = document.createElement('a');
            link.download = (btn.dataset.nama || 'struk') + '.png';
            link.href = canvas.toDataURL('image/png');
            link.click();
        });
    });
</script>

@stack('scripts')

</body>
</html>