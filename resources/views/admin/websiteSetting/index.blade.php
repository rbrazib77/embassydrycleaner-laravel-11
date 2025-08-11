@extends('admin.layouts.bashboard_master')
@section('title', 'New Banner Create')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="content">
        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Website Setting Update</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.website.update',$websiteSetting->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">

                                        <div class="mb-3">
                                            <label for="image" class="form-label">Logo</label>
                                            <input name="logo" class="form-control" type="file" id="image">
                                            @error('icon')
                                                <span class="text-danger" style="font-size: 14px;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <img id="showImage"
                                                src="{{ !empty($websiteSetting->logo) ? url('upload/settings/' . $websiteSetting->logo) : url('upload/no_image.jpg') }}"
                                                class="avatar-xxl img-thumbnail" alt="image profile"
                                                style="width: 20%; height: 100px;">
                                        </div>
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Company Name</label>
                                            <input type="text" name="company_name" id="simpleinput"
                                                class="form-control @error('company_name') is-invalid @enderror"
                                                placeholder="Company Name" value="{{ $websiteSetting->company_name }}">
                                            @error('company_name')
                                                <span class="text-danger" style="font-size: 14px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Phone</label>
                                            <input type="text" name="phone" id="simpleinput"
                                                class="form-control @error('phone') is-invalid @enderror"
                                                placeholder="Phone" value="{{ $websiteSetting->phone }}">
                                            @error('phone')
                                                <span class="text-danger" style="font-size: 14px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-email" class="form-label">Address</label>
                                            <input type="text" name="address" id="example-email"
                                                class="form-control @error('address') is-invalid @enderror"
                                                placeholder="Address" value="{{ $websiteSetting->address }}">
                                            @error('address')
                                                <span class="text-danger" style="font-size: 14px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-textarea" class="form-label">Footer Description</label>
                                            <textarea name="footer_description" class="form-control @error('footer_description') is-invalid @enderror" id="example-textarea"
                                                rows="5" spellcheck="false" placeholder="Footer Description">{{ $websiteSetting->footer_description }}</textarea>
                                            @error('footer_description')
                                                <span class="text-danger" style="font-size: 14px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Favicon </label>
                                            <input name="fav_icon" class="form-control" type="file" id="image">
                                            @error('fav_icon')
                                                <span class="text-danger" style="font-size: 14px;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <img id="showImage"
                                                src="{{ !empty($websiteSetting->fav_icon) ? url('upload/settings/' . $websiteSetting->fav_icon) : url('upload/no_image.jpg') }}"
                                                class="avatar-xxl img-thumbnail" alt="image profile"
                                                style="width: 20%; height: 100px;">
                                        </div>
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">E-mail</label>
                                            <input type="email" name="email" id="simpleinput"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="E-mail" value="{{ $websiteSetting->email }}">
                                            @error('email')
                                                <span class="text-danger" style="font-size: 14px;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="example-email" class="form-label">Working Time</label>
                                            <input type="text" name="working_time" id="example-email"
                                                class="form-control @error('working_time') is-invalid @enderror"
                                                placeholder="Working Time" value="{{ $websiteSetting->working_time }}">
                                            @error('working_time')
                                                <span class="text-danger" style="font-size: 14px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Copy Right</label>
                                            <input type="text" name="copy_right" id="simpleinput"
                                                class="form-control @error('copy_right') is-invalid @enderror"
                                                placeholder="Copy Right" value="{{ $websiteSetting->copy_right }}">
                                            @error('copy_right')
                                                <span class="text-danger" style="font-size: 14px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>
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
