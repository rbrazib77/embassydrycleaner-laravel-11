@extends('admin.layouts.bashboard_master')
@section('admin')
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Banner Item List</h4>
                </div>

                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <a href="{{ route('admin.banner.create') }}" class="btn btn-info btn-sm">New Banner Create</a>
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
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>SubTitle</th>
                                        <th>Button Text</th>
                                        {{-- <th>Date</th> --}}
                                        <th>status</th>
                                        <th>Order</th>
                                        <th>Date</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($banner as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <img src="{{ !empty($item->image) ? url('upload/banners/' . $item->image) : url('upload/no_image.jpg') }}"
                                                    alt="image profile"
                                                    style="width:80px; height:40px; object-fit:cover; border-radius:3px;">
                                            </td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->subtitle }}</td>
                                            <td>{{ $item->button_text }}</td>
                                            {{-- <td>{{ $item->button_url }}</td> --}}
                                            <td>{{ $item->status }}</td>
                                            <td>{{ $item->order }}</td>

                                            <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                            <td>
                                                <a href="{{ route('admin.banner.destroy', $item->id) }}"
                                                    class="btn btn-success">Delete</a>
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
                                                            <form action="{{ route('admin.banner.update', $item->id) }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="editBannerModalLabel{{ $item->id }}">Edit
                                                                        Banner</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label for="editImage{{ $item->id }}"
                                                                            class="form-label">Banner Image</label>
                                                                        <input name="image" class="form-control"
                                                                            type="file"
                                                                            id="editImage{{ $item->id }}">

                                                                        @if ($item->image)
                                                                            <img src="{{ asset('upload/banners/' . $item->image) }}"
                                                                                alt="banner image"
                                                                                class="img-thumbnail mt-2"
                                                                                id="previewImage{{ $item->id }}"
                                                                                style="width: 100%; height: 300px;">
                                                                        @else
                                                                            <img src="{{ url('upload/no_image.jpg') }}"
                                                                                alt="no image" class="img-thumbnail mt-2"
                                                                                id="previewImage{{ $item->id }}"
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
                                                                        <label for="editTitle{{ $item->id }}"
                                                                            class="form-label">Sub Title</label>
                                                                        <input type="text" name="subtitle"
                                                                            id="editTitle{{ $item->id }}"
                                                                            class="form-control"
                                                                            value="{{ old('subtitle', $item->subtitle) }}">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="editTitle{{ $item->id }}"
                                                                            class="form-label">Button Text</label>
                                                                        <input type="text" name="button_text"
                                                                            id="editTitle{{ $item->id }}"
                                                                            class="form-control"
                                                                            value="{{ old('button_text', $item->button_text) }}">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="editTitle{{ $item->id }}"
                                                                            class="form-label">Button Url</label>
                                                                        <input type="text" name="button_url"
                                                                            id="editTitle{{ $item->id }}"
                                                                            class="form-control"
                                                                            value="{{ old('button_url', $item->button_url) }}">
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
        document.getElementById('editImage{{ $item->id }}').addEventListener('change', function(event) {
            const [file] = this.files;
            if (file) {
                const preview = document.getElementById('previewImage{{ $item->id }}');
                preview.src = URL.createObjectURL(file);
            }
        });
    </script>
@endsection
