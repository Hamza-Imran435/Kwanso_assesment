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
                        Manage Users Role and there Permissions
                    </p>
                </div>
            </div>
            <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4 my-2">
                <div class="card">
                    <div class="card-header p-2 ps-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="mb-0">Roles List</h4>
                            </div>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $key => $role)
                                        <tr>
                                            <td class="px-4">{{ $role->name ?? 'N/A' }}</td>
                                            <td>
                                                <a href="{{ route('role.permissions.detail', ['id' => base64_encode($role->id)]) }}"
                                                    class="btn btn-outline-success btn-sm">View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <div id="toast-container" class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                <div id="toast-template" class="toast fade hide" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header border-0">
                        <i class="material-symbols-rounded text-danger me-2">campaign</i>
                        <span class="me-auto text-gradient text-danger font-weight-bold">Validation Error</span>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <hr class="horizontal dark m-0">
                    <div class="toast-body">
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('page-scripts')
@endsection
