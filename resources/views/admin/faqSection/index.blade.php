@extends('admin.layouts.bashboard_master')
@section('title', 'New How It Work Item Create')
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
                                    <form action="{{ route('admin.how.it.works.store') }}" method="POST"
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
                                            <label for="example-textarea" class="form-label">answer</label>
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
