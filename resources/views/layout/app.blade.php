<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Tagihan Cicilan Rumah</title>
    {{-- Bootstrap 5.3 - CSS --}}
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    {{-- IziToast - CSS --}}
    <link rel="stylesheet" href="{{ asset('vendor/izitoast/dist/css/iziToast.min.css') }}">
    {{-- Select2.js --}}
    <link rel="stylesheet" href="{{ asset('vendor/select2js/select2.min.css') }}">
    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
</head>

<body>
    @yield('body')




    {{-- jQuery --}}
    <script src="{{ asset('vendor/jquery/jquery-3.6.3.min.js') }}"></script>
    {{-- Bootstrap 5.3 - JS --}}
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    {{-- IziToast - JS --}}
    <script src="{{ asset('vendor/izitoast/dist/js/iziToast.min.js') }}"></script>
    {{-- Select2.js --}}
    <script src="{{ asset('vendor/select2js/select2.min.js') }}"></script>
    {{-- XLSX --}}
    <script src="{{ asset('vendor/xlsx/xlsx.full.min.js') }}"></script>
    {{-- Custom JS --}}
    <script src="{{ asset('assets/js/main.js') }}"></script>

    {{-- Custom On Page --}}
    @yield('customOnPage')
    {{-- End Custom On Page --}}

    {{-- Alert --}}
    @if (Session::has('loginError'))
        <script>
            iziToast.error({
                title: 'Error',
                message: '{{ Session::get('loginError') }}',
                position: 'bottomLeft',
                icon: 'fa-solid fa-xmark',
                iconColor: '#DC3545',
                titleColor: '#DC3545',
                drag: false,
                pauseOnHover: false,
                iconColor: '#DC3545',
                titleColor: '#DC3545',
            });
        </script>
    @endif

    @if (Session::has('updateS'))
        <script>
            iziToast.success({
                title: 'Success',
                message: 'Data telah berhasil diubah',
                position: 'bottomLeft',
                drag: false,
                pauseOnHover: false,
                iconColor: '#198754',
                titleColor: '#198754',
            });
        </script>
    @endif

    @if (Session::has('deleteS'))
        <script>
            iziToast.success({
                title: 'Success',
                message: 'Data telah berhasil dihapus',
                position: 'bottomLeft',
                drag: false,
                pauseOnHover: false,
                iconColor: '#198754',
                titleColor: '#198754',
            });
        </script>
    @endif

    @if (Session::has('inputSuccess'))
        <script>
            iziToast.success({
                title: 'Success',
                message: 'Data telah berhasil disimpan',
                position: 'bottomLeft',
                drag: false,
                pauseOnHover: false,
                iconColor: '#198754',
                titleColor: '#198754',
            });
        </script>
    @endif

    @if (Session::has('messageSuccess'))
        <script>
            iziToast.success({
                title: 'Success',
                message: 'Pesan telah berhasil dikirim',
                position: 'bottomLeft',
                drag: false,
                pauseOnHover: false,
                iconColor: '#198754',
                titleColor: '#198754',
            });
        </script>
    @endif

    @if (Session::has('loginSuccess'))
        <script>
            iziToast.settings({
                maxToast: 1
            });
            iziToast.error({
                title: 'Success',
                message: 'Login Berhasil',
                position: 'bottomLeft',
                icon: 'fa-solid fa-check',
                iconColor: '#198754',
                titleColor: '#198754',
                drag: false,
                pauseOnHover: false,
            });
        </script>
    @endif
    {{-- End Alert --}}
    @stack('script')
</body>

</html>
