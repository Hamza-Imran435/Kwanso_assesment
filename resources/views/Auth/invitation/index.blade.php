@extends('../../index')
@section('content')
    @include('../../partials/sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        @include('../../partials/navbar')

        <div class="container-fluid py-2">
            <div class="row">
                <div class="ms-3">
                    <h3 class="mb-0 h4 font-weight-bolder">Invites</h3>
                    <p class="mb-4">
                        Invites New Clients.
                    </p>
                </div>
                <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-2 ps-3">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4 class="mb-0">Send Invitation</h4>
                                </div>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer d-flex">
                            <div class="col-md-5">
                                <input type="email" id="email" placeholder="Enter Email" class="form-control px-3"
                                    style="border-color: #ffa516;box-shadow: 0 0 5px rgba(255, 165, 22, 0.6);">
                            </div>
                            <div class="col-md-3 px-4 py-1">
                                <button class="btn btn-success" id="send-invitation">Send Invitation</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4 my-2">
                <div class="card">
                    <div class="card-header p-2 ps-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="mb-0">Invitation List</h4>
                            </div>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-striped">
                                <thead>
                                    <tr>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>john.doe@example.com</td>
                                        <td>
                                            <span class="badge bg-gradient-success">Accepted</span>
                                        </td>
                                        <td>
                                            <button class="btn btn-outline-danger btn-sm">Decline</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>jane.doe@example.com</td>
                                        <td>
                                            <span class="badge bg-gradient-warning">Pending</span>
                                        </td>
                                        <td>
                                            <button class="btn btn-outline-success btn-sm">Accept</button>
                                        </td>
                                    </tr>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                        if (response.success) {
                            alert('Invitation sent successfully!');
                        } else {
                            showToast('Failed to send invitation: ' + response.message);
                        }
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
        });
    </script>
@endsection
