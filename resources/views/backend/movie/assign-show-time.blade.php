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
                <h4 class="py-3 mb-4"><span class="text-muted fw-light">Movie /</span> <a
                        href="{{ route('admin.getmovies') }}" class="text-muted fw-light">List
                        /</a> Assign Show Time </h4>


                <!-- Custom file input -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <h5 class="card-header">Assign Show time for {{ $movie->title }} </h5>


                            <div class="card-body">
                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Date</th>
                                                <th>Show Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <form action="{{ route('admin.store.movie.showtime') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                                                @forelse ($movie_show_dates as $msd)
                                                    <tr>
                                                        <td class="w-25"> {{ $loop->iteration }}. </td>
                                                        <td class="w-25">
                                                            <input type="hidden" name="date[]"
                                                                value="{{ $msd }}"> {{ $msd }}
                                                        </td>
                                                        <td class="w-50">
                                                            <select class="form-select show_time"
                                                                name="show_time[{{ $loop->index }}][]"
                                                                id="show_time_{{ $loop->iteration }}"
                                                                multiple="multiple">
                                                                @foreach ($show_times as $st)
                                                                    <option
                                                                        value="{{ $st->id }}"{{ in_array($st->id, $showTimesByDate[$msd] ?? []) ? 'selected' : '' }}>
                                                                        {{ $st->show_time }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3"></td>
                                                    </tr>
                                                @endforelse
                                                <tr class="text-end">
                                                    <td colspan="3">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </td>
                                                </tr>
                                            </form>
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

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.show_time').select2({
                placeholder: 'Select Show Time',
                width: '100%'

            });
        })
    </script>
@endpush
@include('backend.include.footer')
