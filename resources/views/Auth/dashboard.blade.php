@extends('../index')

@section('content')
    @include('../partials/sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        @include('../partials/navbar')

        <div class="container-fluid py-2">
            <div class="row">
                <div class="ms-3">
                    <h3 class="mb-0 h4 font-weight-bolder">Dashboard</h3>
                    <p class="mb-4">
                        Check the sales, value and bounce rate by country.
                    </p>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-2 ps-3">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="text-sm mb-0 text-capitalize">Todays Money</p>
                                    <h4 class="mb-0">$53k</h4>
                                </div>
                                <div
                                    class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                                    <i class="material-symbols-rounded opacity-10">weekend</i>
                                </div>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-2 ps-3">
                            <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+55% </span>than last
                                week</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-2 ps-3">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="text-sm mb-0 text-capitalize">Today Users</p>
                                    <h4 class="mb-0">2300</h4>
                                </div>
                                <div
                                    class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                                    <i class="material-symbols-rounded opacity-10">person</i>
                                </div>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-2 ps-3">
                            <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+3% </span>than last
                                month</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-2 ps-3">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="text-sm mb-0 text-capitalize">Ads Views</p>
                                    <h4 class="mb-0">3,462</h4>
                                </div>
                                <div
                                    class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                                    <i class="material-symbols-rounded opacity-10">leaderboard</i>
                                </div>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-2 ps-3">
                            <p class="mb-0 text-sm"><span class="text-danger font-weight-bolder">-2% </span>than yesterday
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-header p-2 ps-3">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="text-sm mb-0 text-capitalize">Sales</p>
                                    <h4 class="mb-0">$103,430</h4>
                                </div>
                                <div
                                    class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                                    <i class="material-symbols-rounded opacity-10">weekend</i>
                                </div>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-2 ps-3">
                            <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+5% </span>than
                                yesterday</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                @if (session('success'))
                    <div class="toast fade show p-2 bg-white position-fixed bottom-0 end-0 mb-3 me-3" role="alert"
                        aria-live="assertive" aria-atomic="true">
                        <div class="toast-header border-0">
                            <i class="material-symbols-rounded text-success me-2"> check_circle </i>
                            <span class="me-auto text-gradient text-success font-weight-bold">Success</span>
                        </div>
                        <hr class="horizontal dark m-0">
                        <div class="toast-body">
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                @if ($errors->any())
                    @foreach ($errors->all() as $message)
                        <div class="toast fade show p-2 bg-white position-fixed bottom-0 end-0 mb-3 me-3" role="alert"
                            aria-live="assertive" aria-atomic="true">
                            <div class="toast-header border-0">
                                <i class="material-symbols-rounded text-danger me-2"> campaign </i>
                                <span class="me-auto text-gradient text-danger font-weight-bold">Validation
                                    Error</span>
                            </div>
                            <hr class="horizontal dark m-0">
                            <div class="toast-body">
                                {{ $message }}
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </main>
@endsection
@section('page-scripts')
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('.toast').fadeOut();
            }, 3000);
        });
    </script>
@endsection
