@extends('main')
@section('contents')

    <div class="container-fluid flex-grow-1 container-p-y">
        <h3 class="fw-bold text-primary py-3 mb-4">{{$title}}</h3>
        <div class='row'>
            <div class='col-lg-4 col-md-12 col-6 mb-4'>
                <div class='card'>
                    <div class='card-body'>
                        <div
                            class='card-title d-flex align-items-start justify-content-between'
                        >
                        <span class='fw-semibold d-block mb-1 fs-5'>Tổng doanh thu thực tế </span>

                            <div class='avatar flex-shrink-0'>
                                <img
                                    src='/temp/img/icons/unicons/chart-success.png'
                                    alt='chart success'
                                    class='rounded'
                                />
                            </div>
                        </div>
                        <h3 class='card-title mb-2 currency'>{{$tongDoanhThuThucTe}}</h3>
                    </div>
                </div>
            </div>
            <div class='col-lg-4 col-md-12 col-6 mb-4'>
                <div class='card'>
                    <div class='card-body'>
                        <div
                            class='card-title d-flex align-items-start justify-content-between'
                        >
                        <span class='fw-semibold d-block mb-1 fs-5'>Tổng doanh thu dự kiến</span>

                            <div class='avatar flex-shrink-0'>
                                <img
                                    src='/temp/img/icons/unicons/chart-success.png'
                                    alt='chart success'
                                    class='rounded'
                                />
                            </div>
                        </div>
                        <h3 class='card-title mb-2 currency'>{{$tongDoanhThuDuKien}}</h3>
                    </div>
                </div>
            </div>
            <div class='col-lg-4 col-md-12 col-6 mb-4'>
                <div class='card'>
                    <div class='card-body'>
                        <div
                            class='card-title d-flex align-items-start justify-content-between'
                        >
                        <span class='fw-semibold d-block mb-1 fs-5'>Tổng tiền còn thiếu</span>

                            <div class='avatar flex-shrink-0'>
                                <img
                                    src='/temp/img/icons/unicons/chart-success.png'
                                    alt='chart success'
                                    class='rounded'
                                />
                            </div>
                        </div>
                        <h3 class='card-title mb-2 currency'>{{$tongTienThieu}}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <form class="form-search" method="GET" action="{{ route('doanhthus.index') }}">
                @csrf
                <div class="d-flex align-items-center mb-4">
                    <h4 class="ten-game me-3 mb-0">Tìm kiếm</h4>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12 mb-3">
                            <input class="form-control shadow-none" 
                                   type="text" 
                                   id="searchInputVk" 
                                   name="search_kho_name" 
                                   placeholder="Tìm theo tên kho" 
                                   value="{{ request()->search_kho_name }}">
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12 mb-3">
                            <div class="text-center text-nowrap">
                                <button type="submit" class="btn btn-danger rounded-pill">
                                    <i class="fas fa-search me-2"></i>Tìm kiếm
                                </button>
                                <a href="{{ route('doanhthus.index') }}" class="btn btn-secondary rounded-pill ms-2">
                                    <i class="fas fa-times me-2"></i>Xóa lọc
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        
        <div class="card">
            <div class="d-flex p-4 justify-content-between">
                <h5 class=" fw-bold">Thông kê doanh thu theo KHO  </h5>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên Kho</th>
                        <th>Tổng Doanh Thu Thực Tế</th>
                        <th>Tổng Doanh Thu Dự Kiến</th>
                        <th class="fw-bold text-danger">Tiền Thiếu</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($doanhThuTheoKho as $doanhthu)
                        <tr>
                            <td> {{ $loop->iteration }}</td>
                            <td>{{ $doanhthu->ten_kho }}</td>
                            <td class="currency">{{ $doanhthu->tong_doanh_thu_thuc_te }}</td>
                            <td class="currency">{{ $doanhthu->tong_doanh_thu_du_kien }}</td>
                            <td class="fw-bold text-danger currency">{{ $doanhthu->tien_thieu }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                
                {{-- <div class="pagination mt-4 pb-4">
                    {{ $doanhThuTheoKho->links() }}
                </div> --}}
            </div>
        </div>
    </div>
@endsection

