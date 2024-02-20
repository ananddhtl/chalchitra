@include('backend.include.header')
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->
        @include('backend.include.sidebar')

        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->

            <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                id="layout-navbar">
                <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                        <i class="mdi mdi-menu mdi-24px"></i>
                    </a>
                </div>

                <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                    <!-- Search -->
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            <i class="mdi mdi-magnify mdi-24px lh-0"></i>
                            <input type="text" class="form-control border-0 shadow-none bg-body"
                                placeholder="Search..." aria-label="Search..." />
                        </div>
                    </div>
                    <!-- /Search -->

                    <ul class="navbar-nav flex-row align-items-center ms-auto">
                        <!-- Place this tag where you want the button to render. -->
                        <li class="nav-item lh-1 me-3">
                            <a class="github-button"
                                href="https://github.com/themeselection/materio-bootstrap-html-admin-template-free"
                                data-icon="octicon-star" data-size="large" data-show-count="true"
                                aria-label="Star themeselection/materio-bootstrap-html-admin-template-free on GitHub">Star</a>
                        </li>

                        <!-- User -->
                        <li class="nav-item navbar-dropdown dropdown-user dropdown">
                            <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);"
                                data-bs-toggle="dropdown">
                                <div class="avatar avatar-online">
                                    <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end mt-3 py-2">
                                <li>
                                    <a class="dropdown-item pb-2 mb-1" href="#">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-2 pe-1">
                                                <div class="avatar avatar-online">
                                                    <img src="../assets/img/avatars/1.png" alt
                                                        class="w-px-40 h-auto rounded-circle" />
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0">John Doe</h6>
                                                <small class="text-muted">Admin</small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown-divider my-1"></div>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="mdi mdi-account-outline me-1 mdi-20px"></i>
                                        <span class="align-middle">My Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="mdi mdi-cog-outline me-1 mdi-20px"></i>
                                        <span class="align-middle">Settings</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <span class="d-flex align-items-center align-middle">
                                            <i class="flex-shrink-0 mdi mdi-credit-card-outline me-1 mdi-20px"></i>
                                            <span class="flex-grow-1 align-middle ms-1">Billing</span>
                                            <span
                                                class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown-divider my-1"></div>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0);">
                                        <i class="mdi mdi-power me-1 mdi-20px"></i>
                                        <span class="align-middle">Log Out</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!--/ User -->
                    </ul>
                </div>
            </nav>

            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->

                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Movie /</span> Add Movie</h4>



                    <!-- Custom file input -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <h5 class="card-header">Add Movie</h5>
                                <form action="{{ route('admin.storemovie') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body demo-vertical-spacing demo-only-element">
                                        <div class="input-group input-group-merge">
                                            <label class="input-group-text">Title :-</label>
                                            <input type="text" class="form-control" placeholder="Enter Movie Title"
                                                aria-label="Enter Movie Title" name="title"
                                                aria-describedby="basic-addon33">

                                        </div>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="thumbnail"
                                                id="inputGroupFile02" />
                                            <label class="input-group-text" for="inputGroupFile02">Thumbnail</label>
                                        </div>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text">Descripiton</span>
                                            <textarea class="form-control" name="description" aria-label="With textarea" style="height: 139px;"></textarea>
                                        </div>

                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text">Trailer Iframe Link</span>
                                            <textarea class="form-control" name="iframelink" aria-label="With textarea" style="height: 139px;"></textarea>
                                        </div>
                                        <div class="input-group input-group-merge">
                                            <label class="input-group-text">Movie Duration :-</label>
                                            <input type="text" class="form-control" name="time_duration"
                                                placeholder="Enter time duration" aria-label="Enter Movie Title"
                                                aria-describedby="basic-addon33">
                                        </div>
                                        <div class="input-group input-group-merge">
                                            <label class="input-group-text">Select category:-</label>
                                            <select class="form-control" name="category"
                                                aria-describedby="basic-addon33">
                                                <option>Please Select the Movie category</option>
                                                @foreach($category as $item)
                                                <option value="{{$item->id}}" >{{$item->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="input-group input-group-merge">
                                            <label class="input-group-text">Release Date :-</label>
                                            <input type="date" class="form-control" name="publish_date"
                                                placeholder="Enter release date" aria-label="Enter Movie Title"
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
