@extends('../../index')
@section('content')
    @include('../../partials/sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        @include('../../partials/navbar')

        <div class="container-fluid py-2">
            <div class="row">
                <div class="ms-3">
                    <h3 class="mb-0 h4 font-weight-bolder">Customers</h3>
                    <p class="mb-4">
                        Manage Customers.
                    </p>
                </div>
            </div>
            <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4 my-2">
                <div class="card">
                    <div class="card-header p-2 ps-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="mb-0">Customers List</h4>
                            </div>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped yajra-datatable">
                                <thead>
                                    <tr>
                                        <th>SR No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                        <span class="me-auto text-gradient text-danger font-weight-bold">Message</span>
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
    <script>
        $(document).ready(function() {

            function showToast(message) {
                const toastTemplate = $('#toast-template').clone().removeAttr('id');
                toastTemplate.find('.toast-body').text(message);
                toastTemplate.removeClass('hide').addClass('show').css('margin-bottom', '10px');
                $('#toast-container').append(toastTemplate);

                const toast = new bootstrap.Toast(toastTemplate[0]);
                toast.show();

                setTimeout(function() {
                    toastTemplate.fadeOut(500, function() {
                        toast.dispose();
                        $(this).remove();
                    });
                }, 5000);
            }

            var table = $('.yajra-datatable').DataTable({
                oLanguage: {
                    "sSearch": "Search"
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('client.list') }}",
                    type: 'GET',
                    data: function(d) {}
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name',
                        searchable: true,
                        orderable: true,
                    },
                    {
                        data: 'email',
                        name: 'email',
                        searchable: true,
                        orderable: true,
                    },
                    {
                        data: 'phone',
                        name: 'phone',
                        searchable: true,
                        orderable: true,
                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        orderable: false,
                    }
                ]
            });
        });
    </script>
@endsection
