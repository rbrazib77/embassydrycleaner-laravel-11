@extends('admin.layouts.bashboard_master')
@section('title', 'Frequently asked questions')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="content">
        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Frequently asked questions section</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="{{ route('admin.faq.section.update', $faqSection->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Heading</label>
                                            <input type="text" name="heading" id="simpleinput"
                                                class="form-control @error('heading') is-invalid @enderror"
                                                placeholder="Heading" value="{{ $faqSection->heading }}">
                                            @error('heading')
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
                                                src="{{ !empty($faqSection->image) ? url('upload/faq/' . $faqSection->image) : url('upload/no_image.jpg') }}"
                                                class="avatar-xxl img-thumbnail" alt="image profile"
                                                style="width: 100%; height: 300px;">
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-select" class="form-label">Status</label>
                                            <select name="status" class="form-select" id="example-select">
                                                <option value="1" {{ $faqSection->status ? 'selected' : '' }}>Active
                                                </option>
                                                <option value="0" {{ !$faqSection->status ? 'selected' : '' }}>Deactive
                                                </option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </form>

                                </div>
                                <div class="col-lg-6">
                                    <form action="{{ route('admin.faq.question.answer.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Question</label>
                                            <input type="text" name="question" id="simpleinput"
                                                class="form-control @error('question') is-invalid @enderror"
                                                placeholder="Question" value="{{ old('title') }}">
                                            @error('question')
                                                <span class="text-danger" style="font-size: 14px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-textarea" class="form-label">Answer</label>
                                            <textarea name="answer" class="form-control @error('answer') is-invalid @enderror" id="example-textarea" rows="5"
                                                spellcheck="false" placeholder="Answer">{{ old('answer') }}</textarea>
                                            @error('answer')
                                                <span class="text-danger" style="font-size: 14px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-email" class="form-label">Order</label>
                                            <input type="text" name="order" id="example-email"
                                                class="form-control @error('order') is-invalid @enderror"
                                                placeholder="Order" value="{{ old('order') }}">
                                            @error('order')
                                                <span class="text-danger" style="font-size: 14px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-select" class="form-label">Status</label>
                                            <select name="status" class="form-select" id="example-select">
                                                <option value="1">Active</option>
                                                <option value="0">Deactive</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Faq question answer item list</h4>
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
                                        <th>Question</th>
                                        <th>Answer</th>
                                        <th>status</th>
                                        <th>Order</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($faq as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                {{ Str::words($item->question, 4, '......') }}
                                            </td>
                                            <td>{{ Str::words($item->answer, 8, '......') }}</td>
                                            <td>
                                                <a href="javascript:void(0);"
                                                    class="toggle-status  {{ $item->status ? 'badge text-bg-primary' : 'badge text-bg-secondary' }}"
                                                    data-url="{{ route('admin.faq.question.answer.active.deactive', $item->id) }}"
                                                    data-status="{{ $item->status ? 'deactivate' : 'activate' }}">
                                                    {{ $item->status ? 'Active' : 'Inactive' }}
                                                </a>
                                            </td>
                                            <td>{{ $item->order }}</td>
                                            <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                            <td>
                                                <a href="{{ route('admin.faq.question.answer.view', $item->id) }}"
                                                    class="btn btn-primary">View</a>
                                                <a href="javascript:void(0);" class="btn btn-danger delete-btn"
                                                    data-url="{{ route('admin.faq.question.answer.destroy', $item->id) }}">Delete</a>
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
                                                            <form
                                                                action="{{ route('admin.faq.question.answer.update', $item->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="editBannerModalLabel{{ $item->id }}">Edit
                                                                        Question Answer <span
                                                                            class="badge text-bg-success">{{ $item->order }}</span>
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>

                                                                <div class="modal-body">


                                                                    <div class="mb-3">
                                                                        <label for="simpleinput"
                                                                            class="form-label">Question</label>
                                                                        <input type="text" name="question"
                                                                            id="simpleinput"
                                                                            class="form-control @error('question') is-invalid @enderror"
                                                                            placeholder="Question"
                                                                            value="{{ $item->question }}">
                                                                        @error('question')
                                                                            <span class="text-danger"
                                                                                style="font-size: 14px;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="example-textarea"
                                                                            class="form-label">Answer</label>
                                                                        <textarea name="answer" class="form-control @error('answer') is-invalid @enderror" id="example-textarea"
                                                                            rows="5" spellcheck="false" placeholder="Answer">{{ $item->answer }}</textarea>
                                                                        @error('answer')
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
@endpush
