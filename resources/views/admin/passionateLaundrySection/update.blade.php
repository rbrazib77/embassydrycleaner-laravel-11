@extends('admin.layouts.bashboard_master')
@section('title', 'passionate-about-laundry-section')
@section('admin')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="content">
        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Passionate about laundry section update</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form
                                        action="{{ route('admin.passionate.about.laundry.update', $passionateAboutLaundrySection->id) }}"
                                        method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Heading</label>
                                            <input type="text" name="heading" id="simpleinput"
                                                class="form-control @error('heading') is-invalid @enderror"
                                                placeholder="Heading" value="{{ $passionateAboutLaundrySection->heading }}">
                                            @error('heading')
                                                <span class="text-danger" style="font-size: 14px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-textarea" class="form-label">Content</label>
                                            <textarea name="content" class="form-control @error('content') is-invalid @enderror" id="example-textarea" rows="8" spellcheck="false"
                                                placeholder="Content" autocomplete="off">{{ $passionateAboutLaundrySection->content }}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="example-select" class="form-label">Status</label>
                                            <select name="status" class="form-select" id="example-select">
                                                <option
                                                    value="1"{{ $passionateAboutLaundrySection->status ? 'selected' : '' }}>
                                                    Active</option>
                                                <option
                                                    value="0"{{ !$passionateAboutLaundrySection->status ? 'selected' : '' }}>
                                                    Deactive</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update</button>
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
