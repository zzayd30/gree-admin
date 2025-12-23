<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gree Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('admin.include.navbar')
        @include('admin.include.sidebar')

        <div class="content-wrapper">
            @yield('content')
        </div>
        <footer class="main-footer">
            <strong>Copyright &copy; {{ date('Y') }} CreamerzSoft. All rights reserved.</strong>
        </footer>

    </div>
    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('admin/js/demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Initialize Summernote
            $('.summernote').summernote({
                height: 300
            });

            // Initialize Select2 globally
            $('.select2').select2({
                width: '100%',
                placeholder: function() {
                    return $(this).data('placeholder') || 'Select an option';
                },
                allowClear: true,
                theme: 'default'
            });
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        @yield('customjs')
    </script>
</body>

</html>
