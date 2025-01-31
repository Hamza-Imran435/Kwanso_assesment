@extends('../../index')
@section('content')
    @include('../../partials/sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        @include('../../partials/navbar')

        <div class="container-fluid py-2">
            <div class="row">
                <div class="ms-3">
                    <h3 class="mb-0 h4 font-weight-bolder">Customer Detail</h3>
                    <p class="mb-4">
                        Customer Detail
                    </p>
                </div>
                <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-2 ps-3">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4 class="mb-0">{{ $customer->name }}</h4>
                                </div>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer d-flex">
                            <div class="col-md-3">
                                <h6> <small>Email : </small> {{ $customer->email }}</h6>
                            </div>
                            <div class="col-md-3 px-4 py-1">
                                <h6> <small>Phone : </small> {{ $customer->phone }}</h6>
                            </div>
                            <div class="col-md-3 px-4 py-1">
                                <h6> <small>Joined At : </small> {{ $customer->created_at }}</h6>
                            </div>
                            <div class="col-md-3 px-4 py-1">
                                <h6><small>Profile Image:</small></h6>
                                <img src="{{ asset('storage/' . $customer->image) }}" alt="Profile Image"
                                    class="img-fluid rounded" width="100">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4 my-2">
                <div class="card">
                    <div class="card-header p-2 ps-3">
                        @if (auth()->check() && auth()->user()->hasPermission('assign-task'))
                            <div class="d-flex justify-content-between mt-2">
                                <button class="btn btn-success" id="openAssignTaskModal">Assign Task</button>
                            </div>
                        @endif
                        <div class="d-flex justify-content-between mt-3">
                            <div>
                                <h4 class="mb-0">Task List</h4>
                            </div>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-striped yajra-datatable">
                                <thead>
                                    <tr>
                                        <th>SR No</th>
                                        <th>Email</th>
                                        <th>Status</th>
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

        <div class="modal fade" id="assignTaskModal" tabindex="-1" aria-labelledby="assignTaskModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="openAssignTaskModal">Assign Task</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="assignTaskForm">
                            @csrf
                            <div class="mb-3">
                                <label for="task_id" class="form-label">Select Task</label>
                                <select class="form-control" id="task_id" name="task_id"
                                    style="border-color: #ffa516;box-shadow: 0 0 5px rgba(255, 165, 22, 0.6);">
                                    <option selected disabled>Select
                                        a Task</option>
                                    @foreach ($tasks as $task)
                                        <option value="{{ $task->id }}">{{ $task->task_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" id="customer_id" name="customer_id" value="{{ $customer->id }}">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="assignTaskBtn" class="btn btn-success">Assign Task</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('page-scripts')
    <script>
        $(document).ready(function() {
            $('#send-invitation').on('click', function() {
                const email = $('#email').val();

                $.ajax({
                    url: '{{ route('invitations.send') }}',
                    method: 'POST',
                    data: {
                        email: email,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.success) {
                            showToast(response.message);
                        } else {
                            showToast(response.message);
                        }

                        table.draw();
                    },
                    error: function(xhr, status, error) {
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            Object.values(xhr.responseJSON.errors).forEach(function(message) {
                                showToast(message[
                                    0]);
                            });
                        } else {
                            showToast('An error occurred while sending the invitation.');
                        }
                    }
                });
            });

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
                    url: "{{ route('invitations.list') }}",
                    type: 'GET',
                    data: function(d) {}
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'email',
                        name: 'email',
                        searchable: true,
                        orderable: true,
                    },
                    {
                        data: 'status',
                        name: 'status',
                        searchable: true,
                        orderable: true,
                    }
                ]
            });

            $('#openAssignTaskModal').on('click', function() {
                $('#assignTaskModal').modal('show');
            });

            $('#assignTaskBtn').on('click', function() {
                var taskId = $('#task_id').val();
                var customerId = $('#customer_id').val();

                if (!taskId) {
                    alert('Please select a task.');
                    return;
                }

                $.ajax({
                    url: '{{ route('task.assign') }}',
                    method: 'POST',
                    data: {
                        task_id: taskId,
                        customer_id: customerId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            showToast(response.message);
                        } else {
                            showToast('Failed to send invitation: ' + response.message);
                        }

                        $('#assignTaskModal').modal('hide');
                    },
                    error: function(xhr, status, error) {
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            Object.values(xhr.responseJSON.errors).forEach(function(message) {
                                showToast(message[
                                    0]);
                            });
                        } else {
                            showToast('An error occurred while sending the invitation.');
                        }
                    }
                });
            });
        });
    </script>
@endsection
