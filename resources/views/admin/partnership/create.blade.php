@extends('admin.layouts.bashboard_master')
@section('title', 'Frequently asked questions')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="content">
        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Partnership section</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.partnership.store') }}" enctype="multipart/form-data"
                                method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">

                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Title</label>
                                            <input type="text" name="title" id="simpleinput"
                                                class="form-control @error('title') is-invalid @enderror"
                                                placeholder="Title" value="{{ $partnership->title }}">
                                            @error('title')
                                                <span class="text-danger" style="font-size: 14px;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="example-textarea" class="form-label">Short Description</label>
                                            <textarea name="short_description" class="form-control @error('answer') is-invalid @enderror" id="example-textarea"
                                                rows="5" spellcheck="false" placeholder="Short Description">{{ $partnership->short_description }}</textarea>
                                            @error('short_description')
                                                <span class="text-danger" style="font-size: 14px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Button Text</label>
                                            <input type="text" name="button_text" id="simpleinput"
                                                class="form-control @error('button_text') is-invalid @enderror"
                                                placeholder="Button Text" value="{{ $partnership->button_text }}">
                                            @error('button_text')
                                                <span class="text-danger" style="font-size: 14px;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Button Link</label>
                                            <input type="text" name="button_link" id="simpleinput"
                                                class="form-control @error('button_text') is-invalid @enderror"
                                                placeholder="Button Text" value="{{ $partnership->button_link }}">
                                            @error('button_link')
                                                <span class="text-danger" style="font-size: 14px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Image</label>
                                            <input name="image" class="form-control" type="file" id="image">
                                            @error('image')
                                                <span class="text-danger" style="font-size: 14px;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <img id="showImage"
                                                src="{{ !empty($partnership->image) ? url('upload/partnerships/' . $partnership->image) : url('upload/no_image.jpg') }}"
                                                class="avatar-xxl img-thumbnail" alt="image profile"
                                                style="width: 100%; height: 300px;">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">

                                        <div class="mb-3">
                                            <label class="form-label">Points</label>
                                            <div id="points-wrapper">
                                                @php $points = old('points', $partnership->points ?? []); @endphp
                                                @if (!empty($points))
                                                    @foreach ($points as $point)
                                                        <div class="input-group mb-2">
                                                            <input type="text" name="points[]"
                                                                value="{{ $point }}" class="form-control">
                                                            <button type="button"
                                                                class="btn btn-danger remove-point">X</button>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="input-group mb-2">
                                                        <input type="text" name="points[]" class="form-control"
                                                            placeholder="Enter point">
                                                        <button type="button"
                                                            class="btn btn-danger remove-point">X</button>
                                                    </div>
                                                @endif
                                            </div>
                                            <button type="button" id="add-point" class="btn btn-primary btn-sm">+ Add
                                                Point</button>
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-textarea" class="form-label">Details Description</label>
                                            <textarea name="details_description" class="form-control @error('details_description') is-invalid @enderror"
                                                id="example-textarea" rows="5" spellcheck="false" placeholder="Answer">{{ $partnership->details_description }}</textarea>
                                            @error('details_description')
                                                <span class="text-danger" style="font-size: 14px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-select" class="form-label">Status</label>
                                            <select name="status" class="form-select" id="example-select">
                                                <option value="1"
                                                    {{ old('status', $partnership->status ?? 0) == 1 ? 'selected' : '' }}>
                                                    Active</option>
                                                <option value="0"
                                                    {{ old('status', $partnership->status ?? 0) == 0 ? 'selected' : '' }}>
                                                    Deactive</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            })
        })
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
    {{-- JS for dynamic points --}}
    <script>
        document.getElementById('add-point').addEventListener('click', function() {
            let wrapper = document.getElementById('points-wrapper');
            let div = document.createElement('div');
            div.classList.add('input-group', 'mb-2');
            div.innerHTML = `
            <input type="text" name="points[]" class="form-control" placeholder="Enter point">
            <button type="button" class="btn btn-danger remove-point">X</button>
        `;
            wrapper.appendChild(div);
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-point')) {
                let wrapper = document.getElementById('points-wrapper');
                if (wrapper.querySelectorAll('.input-group').length > 1) {
                    e.target.parentElement.remove();
                } else {
                    e.target.parentElement.querySelector('input').value = '';
                }
            }
        });
    </script>
@endpush
