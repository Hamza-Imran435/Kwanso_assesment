<!DOCTYPE html>
<html lang="en">

@include('partials.head')

<body class="bg-gray-200">

    <div class="blur-background" id="blur-background"></div>

    <div class="loader" id="loader"></div>

    @yield('content')
    @yield('page-scripts')

    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
        window.addEventListener('load', function() {
            const loader = document.getElementById('loader');
            const blurBackground = document.getElementById('blur-background');
            loader.style.display = 'none';
            blurBackground.style.display = 'none';
        });
    </script>

</body>

</html>
