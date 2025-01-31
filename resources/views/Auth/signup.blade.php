@extends('../index')

@section('content')
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-100"
            style="background-image: url('{{ asset('assets/2025-01-28_22-46.png') }}')">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-4 col-md-8 col-12 mx-auto">
                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Sign Up</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('signup.submit') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="input-group input-group-outline my-3">
                                        <input type="hidden" name="invitation" value="{{ $token }}">
                                        <input type="text" name="name" placeholder="Full Name" class="form-control">
                                    </div>
                                    <div class="input-group input-group-outline my-3">
                                        <input type="email" name="email" placeholder="Email" class="form-control">
                                    </div>
                                    <div class="input-group input-group-outline my-3">
                                        <input type="text" name="phone" placeholder="Phone" class="form-control">
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="file" name="image" placeholder="Profile Image"
                                            class="form-control">
                                    </div>
                                    <div class="input-group input-group-outline my-3">
                                        <input type="password" name="password" placeholder="Password" class="form-control">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign
                                            in</button>
                                    </div>
                                </form>
                            </div>
                            @if (session('success'))
                                <div class="toast fade show p-2 bg-white position-fixed bottom-0 end-0 mb-3 me-3"
                                    role="alert" aria-live="assertive" aria-atomic="true">
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
                                    <div class="toast fade show p-2 bg-white position-fixed bottom-0 end-0 mb-3 me-3"
                                        role="alert" aria-live="assertive" aria-atomic="true">
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
                </div>
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
