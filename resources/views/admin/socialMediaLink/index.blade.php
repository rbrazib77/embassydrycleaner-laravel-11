@extends('admin.layouts.bashboard_master')
@section('title', 'Social Media Link List')
@section('admin')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Social Media Link List</h4>
                </div>

                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <a href="{{ route('admin.social.media.link.create') }}" class="btn btn-success">New Social Media Link
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
                                        <th>Name</th>
                                        <th>Url</th>
                                        <th>status</th>
                                        <th>Order</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($socialMediaLink as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <div class="d-inline-flex align-items-center justify-content-center border  bg-light"
                                                    style="height: 40px; width: 40px;">
                                                    <i class="{{ $item->icon_class }} text-dark"
                                                        style="font-size: 20px;"></i>
                                                </div>
                                            </td>
                                            <td>{{ $item->platform }}</td>
                                            <td>{{ $item->url }}</td>
                                            <td>
                                                <a href="javascript:void(0);"
                                                    class="toggle-status  {{ $item->status ? 'badge text-bg-primary' : 'badge text-bg-secondary' }}"
                                                    data-url="{{ route('admin.social.media.link.active.deactive', $item->id) }}"
                                                    data-status="{{ $item->status ? 'deactivate' : 'activate' }}">
                                                    {{ $item->status ? 'Active' : 'Inactive' }}
                                                </a>
                                            </td>
                                            <td>{{ $item->order }}</td>

                                            <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                            <td>
                                                <a href="javascript:void(0);" class="btn btn-danger delete-btn"
                                                    data-url="{{ route('admin.social.media.link.destroy', $item->id) }}">Delete</a>
                                                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                    data-bs-target="#editSocialModal{{ $item->id }}">
                                                    Edit
                                                </button>
                                                <!-- Social Media Edit Modal -->
                                                <div class="modal fade" id="editSocialModal{{ $item->id }}"
                                                    tabindex="-1"
                                                    aria-labelledby="editSocialModalLabel{{ $item->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">
                                                            <form
                                                                action="{{ route('admin.social.media.link.update', $item->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="editSocialModalLabel{{ $item->id }}">
                                                                        Edit Social Link <span
                                                                            class="badge text-bg-success">{{ $item->order }}</span>
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    {{-- Platform --}}
                                                                    <div class="mb-3">
                                                                        <label for="platform{{ $item->id }}"
                                                                            class="form-label">Name</label>
                                                                        <input type="text" name="platform"
                                                                            id="platform{{ $item->id }}"
                                                                            class="form-control @error('platform') is-invalid @enderror"
                                                                            value="{{ old('platform', $item->platform) }}"
                                                                            placeholder="Name">
                                                                        @error('platform')
                                                                            <span class="text-danger"
                                                                                style="font-size: 14px;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    {{-- Icon Class --}}
                                                                    <div class="mb-3">
                                                                        <label for="icon_class{{ $item->id }}"
                                                                            class="form-label">Icon</label>
                                                                        <select name="icon_class" class="form-select"
                                                                            id="iconPicker{{ $item->id }}"
                                                                            onchange="updateIconPreview{{ $item->id }}()">
                                                                            <option value="">Choose...</option>
                                                                            <option value="fa-solid fa-envelope"
                                                                                {{ old('icon_class', $item->icon_class) == 'fa-solid fa-envelope' ? 'selected' : '' }}>
                                                                                Email</option>
                                                                            <option value="fa-brands fa-square-whatsapp"
                                                                                {{ old('icon_class', $item->icon_class) == 'fa-brands fa-square-whatsapp' ? 'selected' : '' }}>
                                                                                WhatsApp</option>
                                                                            <option value="fa-brands fa-square-facebook"
                                                                                {{ old('icon_class', $item->icon_class) == 'fa-brands fa-square-facebook' ? 'selected' : '' }}>
                                                                                Facebook</option>
                                                                            <option value="fab fa-twitter"
                                                                                {{ old('icon_class', $item->icon_class) == 'fab fa-twitter' ? 'selected' : '' }}>
                                                                                Twitter</option>
                                                                            <option value="fab fa-instagram"
                                                                                {{ old('icon_class', $item->icon_class) == 'fab fa-instagram' ? 'selected' : '' }}>
                                                                                Instagram</option>
                                                                            <option value="fab fa-linkedin"
                                                                                {{ old('icon_class', $item->icon_class) == 'fab fa-linkedin' ? 'selected' : '' }}>
                                                                                LinkedIn</option>
                                                                            <option value="fab fa-youtube"
                                                                                {{ old('icon_class', $item->icon_class) == 'fab fa-youtube' ? 'selected' : '' }}>
                                                                                YouTube</option>
                                                                            <option value="fab fa-pinterest"
                                                                                {{ old('icon_class', $item->icon_class) == 'fab fa-pinterest' ? 'selected' : '' }}>
                                                                                Pinterest</option>
                                                                            <option value="fab fa-tiktok"
                                                                                {{ old('icon_class', $item->icon_class) == 'fab fa-tiktok' ? 'selected' : '' }}>
                                                                                TikTok</option>
                                                                        </select>
                                                                    </div>

                                                                    {{-- Icon Preview --}}
                                                                    <div class="form-group col-md-2">
                                                                        <label class="form-label">Icon Preview</label>
                                                                        <div class="border rounded d-flex align-items-center justify-content-center bg-light"
                                                                            style="height: 60px; width: 60px;">
                                                                            <span id="iconPreview{{ $item->id }}"
                                                                                class="text-dark" style="font-size: 28px;">
                                                                                <i
                                                                                    class="{{ old('icon_class', $item->icon_class) }}"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>

                                                                    {{-- URL --}}
                                                                    <div class="mb-4 mt-3">
                                                                        <label for="url{{ $item->id }}"
                                                                            class="form-label">URL</label>
                                                                        <input type="text" name="url"
                                                                            id="url{{ $item->id }}"
                                                                            class="form-control @error('url') is-invalid @enderror"
                                                                            value="{{ old('url', $item->url) }}"
                                                                            placeholder="Url">
                                                                        @error('url')
                                                                            <span class="text-danger"
                                                                                style="font-size: 14px;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    {{-- Order --}}
                                                                    <div class="mb-3">
                                                                        <label for="order{{ $item->id }}"
                                                                            class="form-label">Order</label>
                                                                        <input type="text" name="order"
                                                                            id="order{{ $item->id }}"
                                                                            class="form-control @error('order') is-invalid @enderror"
                                                                            value="{{ old('order', $item->order) }}"
                                                                            placeholder="Order">
                                                                        @error('order')
                                                                            <span class="text-danger"
                                                                                style="font-size: 14px;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    {{-- Status --}}
                                                                    <div class="mb-3">
                                                                        <label for="status{{ $item->id }}"
                                                                            class="form-label">Status</label>
                                                                        <select name="status" class="form-select"
                                                                            id="status{{ $item->id }}">
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
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Update</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Icon Preview JS --}}
                                                <script>
                                                    function updateIconPreview{{ $item->id }}() {
                                                        var iconClass = document.getElementById('iconPicker{{ $item->id }}').value;
                                                        document.getElementById('iconPreview{{ $item->id }}').innerHTML = `<i class="${iconClass}"></i>`;
                                                    }
                                                </script>
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
