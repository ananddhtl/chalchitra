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
                <h4 class="py-3 mb-4"><span class="text-muted fw-light">Movie Category /</span> Add  </h4>



                <!-- Custom file input -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <h5 class="card-header">Add Movie Category</h5>
                            <form action="{{ route('admin.storecategory') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body demo-vertical-spacing demo-only-element">
                                    <div class="input-group input-group-merge">
                                        <label class="input-group-text">Category Title :-</label>
                                        <input type="text" class="form-control" placeholder="Enter category title"
                                             name="title"
                                            aria-describedby="basic-addon33">

                                    </div>
                                    
                                    <div class="d-grid gap-2 col-lg-6 mx-auto">
                                        <button class="btn btn-primary btn-lg waves-effect waves-light"
                                            type="submit">Save</button>

                                    </div>
                                </div>
                            </form>
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
