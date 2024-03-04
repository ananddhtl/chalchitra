@include('backend.include.header')
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->
        @include('backend.include.sidebar')

        @include('backend.include.navbar')

        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="py-3 mb-4"><span class="text-muted fw-light">Movie /</span> List </h4>



                <!-- Custom file input -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <h5 class="card-header">List of Movie </h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Iframe Link</th>
                                            <th>Time Duration</th>
                                            <th>Publish Date</th>
                                            <th>End Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($list as $item)
                                            <tr>
                                                <td>{{ $item->title }}</td>
                                                <td>{{ $item->description }}</td>
                                                <td>{{ $item->iframe_link }}</td>
                                                <td>{{ $item->time_duration }}</td>
                                                <td>{{ $item->publish_date }}</td>
                                                <td>{{ $item->end_date }}</td>
                                                <td class="d-flex">
                                                    <div class="dropdown">
                                                        <button type="button"
                                                            class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="mdi mdi-dots-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu" style="">
                                                            <a class="dropdown-item waves-effect"
                                                                href="{{ route('admin.editcategory', ['id' => $item->id]) }}">
                                                                <i class="mdi mdi-pencil-outline me-1"></i> Edit
                                                            </a>

                                                            <a onclick="confrimDelete('')"class="dropdown-item waves-effect"
                                                                href=""><i
                                                                    class="mdi mdi-trash-can-outline me-1"></i>
                                                                Delete</a>
                                                        </div>
                                                    </div>
                                                    <div class="" title="Assign Show Time">
                                                        <a
                                                            href="{{ route('admin.assignshowtime', ['id' => $item->id]) }}"><i
                                                                class="mdi mdi-information me-1"></i></a>
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
            </div>
            <!-- / Content -->

            <!-- Footer -->

            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->
</div>

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->

@include('backend.include.footer')
