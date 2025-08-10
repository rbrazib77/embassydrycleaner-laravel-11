@extends('admin.layouts.bashboard_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="content">
        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">New Banner Create</h4>
                </div>

                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <a href="{{ route('admin.banner.index') }}" class="btn btn-info">Banner Item List</a>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Banner Image</label>
                                            <input name="image" class="form-control" type="file" id="image">
                                            @error('image')
                                                <span class="text-danger" style="font-size: 14px;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <img id="showImage"
                                                src="{{ !empty($profileData->photo) ? url('upload/user_images/' . $profileData->photo) : url('upload/no_image.jpg') }}"
                                                class="avatar-xxl img-thumbnail" alt="image profile"
                                                style="width: 100%; height: 300px;">
                                        </div>
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Title</label>
                                            <input type="text" name="title" id="simpleinput"
                                                class="form-control @error('title') is-invalid @enderror"
                                                placeholder="Title" value="{{ old('title') }}">
                                            @error('title')
                                                <span class="text-danger" style="font-size: 14px;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="example-email" class="form-label">Subtitle</label>
                                            <input type="text" name="subtitle" id="example-email"
                                                class="form-control @error('subtitle') is-invalid @enderror"
                                                placeholder="Subtitle" value="{{ old('subtitle') }}">
                                            @error('subtitle')
                                                <span class="text-danger" style="font-size: 14px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-email" class="form-label">Button Text</label>
                                            <input type="text" name="button_text" id="example-email"
                                                class="form-control @error('button_text') is-invalid @enderror"
                                                placeholder="Button Text" value="{{ old('button_text') }}">
                                            @error('button_text')
                                                <span class="text-danger" style="font-size: 14px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-email" class="form-label">Button Url</label>
                                            <input type="text" name="button_url" id="example-email"
                                                class="form-control @error('button_url') is-invalid @enderror"
                                                placeholder="Button Url" value="{{ old('button_url') }}">
                                            @error('button_url')
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
