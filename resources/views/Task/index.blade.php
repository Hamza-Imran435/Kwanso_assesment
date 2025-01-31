@extends('../index')
@section('content')
    @include('../partials/sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @include('../partials/navbar')
        <div class="container-fluid py-2">
            <div class="row">
                <div class="ms-3">
                    <h3 class="mb-0 h4 font-weight-bolder">Task</h3>
                    <p class="mb-4">Manage Clients Tasks.</p>
                </div>
            </div>
            <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4 my-2">
                <div class="card">
                    @if (auth()->check() && auth()->user()->hasPermission('create-task'))
                        <div class="card-header p-2 ps-3">
                            <a href="#" class="btn btn-primary mt-2" data-bs-toggle="modal"
                                data-bs-target="#taskModal">
                                <i class="material-symbols-rounded me-2">add</i> Add Task
                            </a>
                            <h4 class="mb-0">Tasks List</h4>
                        </div>
                    @endif

                    <hr class="dark horizontal my-0">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped yajra-datatable">
                                <thead>
                                    <tr>
                                        <th>SR No</th>
                                        <th>Task Name</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="toast-container" class="position-fixed bottom-0 end-0 p-3" style="z-index: 11"></div>
        </div>
    </main>

    <div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskModalLabel">Create Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="taskForm" action="{{ route('task.create') }}" method="POST">
                        @csrf
                        <input type="hidden" id="task_id" name="task_id">
                        <div class="mb-3">
                            <label for="task_name" class="form-label">Task Name</label>
                            <input type="text" class="form-control px-2" id="task_name" name="task_name" required
                                style="border-color: #ffa516;box-shadow: 0 0 5px rgba(255, 165, 22, 0.6);">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control px-2" id="description" name="description" rows="4" required
                                style="border-color: #ffa516;box-shadow: 0 0 5px rgba(255, 165, 22, 0.6);"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="taskForm" class="btn btn-primary">Save Task</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script>
        $(document).ready(function() {
            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('task.list') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'task_name',
                        name: 'task_name'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('#taskModal').on('hidden.bs.modal', function() {
                $('#taskForm')[0].reset();
                $('#task_id').val('');
                $('#taskModalLabel').text('Create Task');
            });

            $('#taskForm').on('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                let url = $('#task_id').val() ? "{{ route('task.update') }}" : "{{ route('task.create') }}";
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#taskModal').modal('hide');
                        showToast(true, response.message);
                        table.ajax.reload();
                    },
                    error: function(xhr) {
                        showToast(false, xhr.responseJSON?.message || 'Something went wrong.');
                    }
                });
            });

            $(document).on('click', '.edit-task', function() {
                let task = $(this).data('task');
                $('#task_id').val(task.id);
                $('#task_name').val(task.task_name);
                $('#description').val(task.description);
                $('#taskModalLabel').text('Edit Task');
                $('#taskModal').modal('show');
            });

            function showToast(type, message) {
                let toastTemplate =
                    `<div class="toast show" role="alert"><div class="toast-body">${message}</div></div>`;
                $('#toast-container').append(toastTemplate).delay(3000).fadeOut();
            }
        });
    </script>
@endsection
