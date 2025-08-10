@extends('admin.layouts.bashboard_master')
@section('admin')
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">User List</h4>
                </div>

                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <a href="{{ route('new.user') }}" class="btn btn-info btn-sm">New User Create</a>
                    </ol>
                </div>
            </div>

            <!-- Datatables  -->
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
                                        <th>Name</th>
                                        <th>E-mail</th>
                                        <th>Phone</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <img src="{{ !empty($item->photo) ? url('upload/user_images/' . $item->photo) : url('upload/no_image.jpg') }}"
                                                    alt="image profile"
                                                    style="width:80px; height:40px; object-fit:cover; border-radius:3px;">
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>
                                                @if (auth()->id() == $item->id)
                                                    <button class="btn btn-success btn-sm" disabled>Delete</button>
                                                @else
                                                    <a href="{{ route('user.destroy', $item->id) }}"
                                                        class="btn btn-success btn-sm">Delete</a>
                                                @endif
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
@endsection
