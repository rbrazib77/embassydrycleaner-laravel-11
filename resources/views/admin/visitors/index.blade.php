@extends('admin.layouts.bashboard_master')
@section('title', 'Website Visitor List')
@section('admin')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Website Visitor List</h4>
                </div>
            </div>
            <!-- Responsive Datatable -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="responsive-datatable"
                                class="table table-bordered table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>SI</th>
                                        <th>IP</th>
                                        <th>URL</th>
                                        <th>Browser</th>
                                        <th>Version</th>
                                        <th>Platform</th>
                                        <th>Platform Version</th>
                                        <th>Device</th>
                                        <th>Country</th>
                                        <th>Visit Count</th>
                                        <th>Last Activity</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($logs as $key=> $log)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $log->ip_address }}</td>
                                            <td>{{ $log->url }}</td>
                                            <td>{{ $log->browser }}</td>
                                            <td>{{ $log->browser_version }}</td>
                                            <td>{{ $log->platform }}</td>
                                            <td>{{ $log->platform_version }}</td>
                                            <td>{{ $log->device }}</td>
                                            <td>{{ $log->country }}</td>
                                            <td>{{ $log->visit_count }}</td>
                                            <td>{{ $log->last_activity }}</td>
                                            <td>
                                                <a href="javascript:void(0);" class="btn btn-danger delete-btn"
                                                    data-url="">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div>
    {{-- <script>
        document.querySelectorAll('.editImage').forEach((input, index) => {
            input.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const preview = this.closest('.mb-3').querySelector('.previewImage');
                    preview.src = URL.createObjectURL(file);
                }
            });
        });
    </script> --}}
@endsection
@push('scripts')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: @json(session('success')),
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif

    @if (session('delete'))
        <script>
            Swal.fire({
                icon: 'warning',
                title: @json(session('delete')),
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif
    <script>
        document.querySelectorAll('.toggle-status').forEach(button => {
            button.addEventListener('click', function() {
                let url = this.dataset.url;
                let action = this.dataset.status;

                Swal.fire({
                    title: 'Are you sure?',
                    text: `You are about to ${action} this Services .`,
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonText: `Yes, ${action} it!`,
                    cancelButtonText: 'Cancel',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-btn');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const url = this.dataset.url;

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This action this delete.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = url;
                        }
                    });
                });
            });
        });
    </script>
@endpush
