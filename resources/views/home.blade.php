@extends('main')
@section('contents')
    <!-- / Navbar -->
    <!-- Content wrapper -->
    <div class='content-wrapper'>
        <!-- Content -->
        <div class='container-xxl flex-grow-1 container-p-y text-dark' >
            <div class='row border-bottom'>
                <div class='col-12 order-1'>
                    <h3>Thống kê</h3>
                    <div class='row'>
                        <div class='col-lg-3 col-md-12 col-6 mb-4'>
                            <div class='card'>
                                <div class='card-body'>
                                    <div
                                        class='card-title d-flex align-items-start justify-content-between'
                                    >
                                    <span class='fw-semibold d-block mb-1 fs-5'>Khách hàng </span>

                                        <div class='avatar flex-shrink-0'>
                                            <img
                                                src='/temp/img/icons/unicons/chart-success.png'
                                                alt='chart success'
                                                class='rounded'
                                            />
                                        </div>
                                    </div>
                                    <h3 class='card-title mb-2'>{{$count_customer}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    <span class="fw-semibold d-block mb-1 fs-5"> Tài khoản quản trị</span>

                                        <div class="avatar flex-shrink-0">
                                            <img src="/temp/img/icons/unicons/chart-success.png" alt="chart success" class="rounded">
                                        </div>
                                    </div>
                                    <h3 class="card-title mb-2">{{$count_admin}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    <span class="fw-semibold d-block mb-1 fs-5">Danh mục sản phẩm</span>

                                        <div class="avatar flex-shrink-0">
                                            <img src="/temp/img/icons/unicons/chart-success.png" alt="chart success" class="rounded">
                                        </div>
                                    </div>
                                    <h3 class="card-title mb-2">{{$count_cate}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    <span class="fw-semibold d-block mb-1 fs-5">Tổng số sản phẩm</span>

                                        <div class="avatar flex-shrink-0">
                                            <img src="/temp/img/icons/unicons/chart-success.png" alt="chart success" class="rounded">
                                        </div>
                                    </div>
                                    <h3 class="card-title mb-2">{{$count_product}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    <span class="fw-semibold d-block mb-1 fs-5">Tổng số lượng sản phẩm</span>

                                        <div class="avatar flex-shrink-0">
                                            <img src="/temp/img/icons/unicons/chart-success.png" alt="chart success" class="rounded">
                                        </div>
                                    </div>
                                    <h3 class="card-title mb-2">{{$totalQuantityProduct}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    <span class="fw-semibold d-block mb-1 fs-5">Tổng hóa đơn cho thuê</span>

                                        <div class="avatar flex-shrink-0">
                                            <img src="/temp/img/icons/unicons/chart-success.png" alt="chart success" class="rounded">
                                        </div>
                                    </div>
                                    <h3 class="card-title mb-2">{{$count_chothue}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    <span class="fw-semibold d-block mb-1 fs-5">Đơn hàng đang thuê</span>

                                        <div class="avatar flex-shrink-0">
                                            <img src="/temp/img/icons/unicons/chart-success.png" alt="chart success" class="rounded">
                                        </div>
                                    </div>
                                    <h3 class="card-title mb-2">{{$count_chothueDangthue}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    <span class="fw-semibold d-block mb-1 fs-5">Đơn hàng đã trả</span>

                                        <div class="avatar flex-shrink-0">
                                            <img src="/temp/img/icons/unicons/chart-success.png" alt="chart success" class="rounded">
                                        </div>
                                    </div>
                                    <h3 class="card-title mb-2">{{$count_chothueDatra}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    <span class="fw-semibold d-block mb-1 fs-5">Tổng doanh thu thực tế</span>

                                        <div class="avatar flex-shrink-0">
                                            <img src="/temp/img/icons/unicons/chart-success.png" alt="chart success" class="rounded">
                                        </div>
                                    </div>
                                    <h3 class="card-title mb-2 currency">{{$tongDoanhThuThucTe}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    <span class="fw-semibold d-block mb-1 fs-5">Tổng doanh thu dự kiến</span>

                                        <div class="avatar flex-shrink-0">
                                            <img src="/temp/img/icons/unicons/chart-success.png" alt="chart success" class="rounded">
                                        </div>
                                    </div>
                                    <h3 class="card-title mb-2 currency">{{$tongDoanhThuDuKien}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    <span class="fw-semibold d-block mb-1 fs-5">Tổng tiền còn thiếu</span>

                                        <div class="avatar flex-shrink-0">
                                            <img src="/temp/img/icons/unicons/chart-success.png" alt="chart success" class="rounded">
                                        </div>
                                    </div>
                                    <h3 class="card-title mb-2 currency">{{$tongTienThieu}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Total Revenue -->
                <!--/ Total Revenue -->
            </div>

            <div class='row border-bottom mt-4 '>
                <div class='col-12 order-1'>
                    <h3>Thống kê hôm nay</h3>
                    <div class='row'>
                        <div class='col-lg-4 col-md-12 col-6 mb-4'>
                            <div class='card'>
                                <div class='card-body'>
                                    <div
                                        class='card-title d-flex align-items-start justify-content-between'
                                    >
                                    <span class='fw-semibold d-block mb-1 fs-5'>Doanh thu thực tế hôm nay </span>

                                        <div class='avatar flex-shrink-0'>
                                            <img
                                                src='/temp/img/icons/unicons/chart-success.png'
                                                alt='chart success'
                                                class='rounded'
                                            />
                                        </div>
                                    </div>
                                    <h3 class='card-title mb-2 currency'>{{$tongDoanhThuThucTeHomNay}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-4 col-md-12 col-6 mb-4'>
                            <div class='card'>
                                <div class='card-body'>
                                    <div
                                        class='card-title d-flex align-items-start justify-content-between'
                                    >
                                    <span class='fw-semibold d-block mb-1 fs-5'>Doanh thu dự kiến hôm nay </span>

                                        <div class='avatar flex-shrink-0'>
                                            <img
                                                src='/temp/img/icons/unicons/chart-success.png'
                                                alt='chart success'
                                                class='rounded'
                                            />
                                        </div>
                                    </div>
                                    <h3 class='card-title mb-2 currency'>{{$tongDoanhThuDuKienHomNay}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-4 col-md-12 col-6 mb-4'>
                            <div class='card'>
                                <div class='card-body'>
                                    <div
                                        class='card-title d-flex align-items-start justify-content-between'
                                    >
                                    <span class='fw-semibold d-block mb-1 fs-5'>Tổng tiền thiếu hôm nay</span>

                                        <div class='avatar flex-shrink-0'>
                                            <img
                                                src='/temp/img/icons/unicons/chart-success.png'
                                                alt='chart success'
                                                class='rounded'
                                            />
                                        </div>
                                    </div>
                                    <h3 class='card-title mb-2 currency'>{{$tongTienThieuHomNay}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class='row mt-4 '>
                <div class='col-12 order-1'>
                    <h3>Thống kê tháng này</h3>
                    <div class='row'>
                        <div class='col-lg-4 col-md-12 col-6 mb-4'>
                            <div class='card'>
                                <div class='card-body'>
                                    <div
                                        class='card-title d-flex align-items-start justify-content-between'
                                    >
                                    <span class='fw-semibold d-block mb-1 fs-5'>Doanh thu thực tế tháng này </span>

                                        <div class='avatar flex-shrink-0'>
                                            <img
                                                src='/temp/img/icons/unicons/chart-success.png'
                                                alt='chart success'
                                                class='rounded'
                                            />
                                        </div>
                                    </div>
                                    <h3 class='card-title mb-2 currency'>{{$tongDoanhThuThucTeThangNay}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-4 col-md-12 col-6 mb-4'>
                            <div class='card'>
                                <div class='card-body'>
                                    <div
                                        class='card-title d-flex align-items-start justify-content-between'
                                    >
                                    <span class='fw-semibold d-block mb-1 fs-5'>Doanh thu dự kiến tháng này </span>

                                        <div class='avatar flex-shrink-0'>
                                            <img
                                                src='/temp/img/icons/unicons/chart-success.png'
                                                alt='chart success'
                                                class='rounded'
                                            />
                                        </div>
                                    </div>
                                    <h3 class='card-title mb-2 currency'>{{$tongDoanhThuDuKienThangNay}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-4 col-md-12 col-6 mb-4'>
                            <div class='card'>
                                <div class='card-body'>
                                    <div
                                        class='card-title d-flex align-items-start justify-content-between'
                                    >
                                    <span class='fw-semibold d-block mb-1 fs-5'>Tổng tiền thiếu tháng này</span>

                                        <div class='avatar flex-shrink-0'>
                                            <img
                                                src='/temp/img/icons/unicons/chart-success.png'
                                                alt='chart success'
                                                class='rounded'
                                            />
                                        </div>
                                    </div>
                                    <h3 class='card-title mb-2 currency'>{{$tongTienThieuThangNay}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->
        <!-- Footer -->
        <footer class='content-footer footer bg-footer-theme'>
            <div
                class='container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column'
            >
                <div class='mb-2 mb-md-0'>
                    ©
                    <script>
                        document.write(new Date().getFullYear());
                    </script>2023 , made with ❤️ by
                    <a
                        href='https://themeselection.com'
                        target='_blank'
                        class='footer-link fw-bolder'
                    >ThemeSelection</a>
                </div>
                <div>
                    <a
                        href='https://themeselection.com/license/'
                        class='footer-link me-4'
                        target='_blank'
                    >License</a>
                    <a
                        href='https://themeselection.com/'
                        target='_blank'
                        class='footer-link me-4'
                    >More Themes</a>
                    <a
                        href='https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/'
                        target='_blank'
                        class='footer-link me-4'
                    >Documentation</a>
                    <a
                        href='https://github.com/themeselection/sneat-html-admin-template-free/issues'
                        target='_blank'
                        class='footer-link me-4'
                    >Support</a>
                </div>
            </div>
        </footer>
        <!-- / Footer -->
        <div class='content-backdrop fade'></div>
    </div>
    <!-- Content wrapper -->
@endsection
