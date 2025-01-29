@extends('../../index')

@section('content')
    @include('../../partials/sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @include('../../partials/navbar')

        <div class="container-fluid py-2">
            <div class="row">
                <div class="ms-3">
                    <h3 class="mb-0 h4 font-weight-bolder">Roles & Permissions</h3>
                    <p class="mb-4">
                        Detail View of Role & Permissions
                    </p>
                </div>
            </div>

            <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4 my-2">
                <div class="card">
                    <div class="card-header p-2 ps-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="mb-0">{{ $role->name }}</h4>
                            </div>
                        </div>
                    </div>

                    <hr class="dark horizontal my-0">

                    <div class="card-body">
                        <h5>Permissions:</h5>

                        <form action="{{ route('role.permissions.update', ['id' => $role->id]) }}" method="POST">
                            @csrf
                            <div class="row">
                                @foreach ($permissions as $permission)
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                                id="permission_{{ $permission->id }}" class="form-check-input"
                                                {{ $role->permissions->contains('id', $permission->id) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="permission_{{ $permission->id }}">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <button type="submit" class="btn btn-success mt-3">Update Permissions</button>
                        </form>

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
