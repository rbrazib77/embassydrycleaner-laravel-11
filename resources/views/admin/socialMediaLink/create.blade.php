@extends('admin.layouts.bashboard_master')
@section('title', 'Social Media Link Create')
@section('admin')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="content">
        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">New Social Media Link Create</h4>
                </div>

                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <a href="{{ route('admin.social.media.link.index') }}" class="btn btn-success">Social Media Link
                            List</a>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="{{ route('admin.social.media.link.store') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Name</label>
                                            <input type="text" name="platform" id="simpleinput"
                                                class="form-control @error('platform') is-invalid @enderror"
                                                placeholder="Name" value="{{ old('platform') }}">
                                            @error('platform')
                                                <span class="text-danger" style="font-size: 14px;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="example-select" class="form-label">Status</label>
                                            <select name="icon_class" class="form-select" id="iconPicker"
                                                onchange="updateIconPreview()">
                                                <option selected="">Choose...</option>
                                                <option value="fa-solid fa-envelope">Email</option>
                                                <option value="fa-brands fa-square-whatsapp">Whatsup</option>
                                                <option value="fa-brands fa-square-facebook">Facebook</option>
                                                <option value="fab fa-twitter">Twitter</option>
                                                <option value="fab fa-instagram">Instagram</option>
                                                <option value="fab fa-linkedin">LinkedIn</option>
                                                <option value="fab fa-youtube">YouTube</option>
                                                <option value="fab fa-pinterest">Pinterest</option>
                                                <option value="fab fa-tiktok">TikTok</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="iconPreview" class="form-label">Icon Preview</label>
                                            <div class="border rounded d-flex align-items-center justify-content-center bg-light"
                                                style="height: 60px; width: 60px;">
                                                <span id="iconPreview" class="icon-preview text-dark"
                                                    style="font-size: 28px;"></span>
                                            </div>
                                        </div>
                                        <div class="mb-4 mt-3">
                                            <label for="example-email" class="form-label">URL</label>
                                            <input type="text" name="url" id="example-email"
                                                class="form-control @error('url') is-invalid @enderror" placeholder="Url"
                                                value="{{ old('url') }}">
                                            @error('url')
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
    <script>
        function updateIconPreview() {
            const iconClass = document.getElementById('iconPicker').value;
            const preview = document.getElementById('iconPreview');
            preview.className = 'icon-preview ' + iconClass;
        }
    </script>
@endsection
