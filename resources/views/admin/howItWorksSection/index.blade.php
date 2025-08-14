@extends('admin.layouts.bashboard_master')
@section('title', 'How It Work Item List')
@section('admin')
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">How It Works Item List</h4>
                </div>

                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <a href="{{ route('admin.how.it.works.create') }}" class="btn btn-success">New How It Works Item
                            Create</a>
                    </ol>
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
                                        <th>Icon</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>status</th>
                                        <th>Order</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($howItwork as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <img src="{{ !empty($item->icon) ? url('upload/how_it_works/' . $item->icon) : url('upload/no_image.jpg') }}"
                                                    alt="image profile"
                                                    style="width:80px; height:40px; object-fit:cover; border-radius:3px;">
                                            </td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td>
                                                <a href="javascript:void(0);"
                                                    class="toggle-status  {{ $item->status ? 'badge text-bg-primary' : 'badge text-bg-secondary' }}"
                                                    data-url="{{ route('admin.how.it.works.active.deactive', $item->id) }}"
                                                    data-status="{{ $item->status ? 'deactivate' : 'activate' }}">
                                                    {{ $item->status ? 'Active' : 'Inactive' }}
                                                </a>
                                            </td>
                                            <td>{{ $item->order }}</td>
                                            <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                            <td>
                                                <a href="javascript:void(0);" class="btn btn-danger delete-btn"
                                                    data-url="{{ route('admin.how.it.works.destroy', $item->id) }}">Delete</a>
                                                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                    data-bs-target="#editBannerModal{{ $item->id }}">
                                                    Edit
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="editBannerModal{{ $item->id }}"
                                                    tabindex="-1"
                                                    aria-labelledby="editBannerModalLabel{{ $item->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">
                                                            <form action="{{ route('admin.how.it.works.update', $item->id) }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="editBannerModalLabel{{ $item->id }}">Edit
                                                                        How It Works Item <span
                                                                            class="badge text-bg-success">{{ $item->order }}</span>
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Icon</label>
                                                                        <input name="icon" class="form-control editImage"
                                                                            type="file">

                                                                        @if ($item->icon)
                                                                            <img src="{{ asset('upload/how_it_works/' . $item->icon) }}"
                                                                                alt="banner image"
                                                                                class="img-thumbnail mt-2 previewImage"
                                                                                style="width: 100%; height: 300px;">
                                                                        @else
                                                                            <img src="{{ url('upload/no_image.jpg') }}"
                                                                                alt="no image"
                                                                                class="img-thumbnail mt-2 previewImage"
                                                                                style="width: 100%; height: 300px;">
                                                                        @endif
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="editTitle{{ $item->id }}"
                                                                            class="form-label">Title</label>
                                                                        <input type="text" name="title"
                                                                            id="editTitle{{ $item->id }}"
                                                                            class="form-control"
                                                                            value="{{ old('title', $item->title) }}">
                                                                    </div>



                                                                    <div class="mb-3">
                                                                        <label for="example-textarea{{ $item->id }}"
                                                                            class="form-label">Description</label>
                                                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                                                            id="example-textarea{{ $item->id }}" rows="5" spellcheck="false" placeholder="Description">{{ $item->description }}</textarea>
                                                                        @error('description')
                                                                            <span class="text-danger"
                                                                                style="font-size: 14px;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="editTitle{{ $item->id }}"
                                                                            class="form-label">Order</label>
                                                                        <input type="text" name="order"
                                                                            id="editTitle{{ $item->id }}"
                                                                            class="form-control"
                                                                            value="{{ old('order', $item->order) }}">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="editStatus{{ $item->id }}"
                                                                            class="form-label">Status</label>
                                                                        <select name="status" class="form-select"
                                                                            id="editStatus{{ $item->id }}">
                                                                            <option value="1"
                                                                                {{ old('status', $item->status) == 1 ? 'selected' : '' }}>
                                                                                Active</option>
                                                                            <option value="0"
                                                                                {{ old('status', $item->status) == 0 ? 'selected' : '' }}>
                                                                                Deactive</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary">Update
                                                                    </button>
                                                                </div>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
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
    <script>
        document.querySelectorAll('.editImage').forEach((input, index) => {
            input.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const preview = this.closest('.mb-3').querySelector('.previewImage');
                    preview.src = URL.createObjectURL(file);
                }
            });
        });
    </script>
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
