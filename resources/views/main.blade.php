<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="/admin/assets/"
    data-template="vertical-menu-template-free"
>
<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>{{$title }}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    @include('header')

</head>
<body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->

    @include('sidebar')

        <!-- Layout container -->
        <div class="layout-page admin">
            <nav class="layout-navbar container-fluid navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                        <i class="bx bx-menu bx-sm"></i>
                    </a>
                </div>
                <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                <button type="button" data-id="" class="btn btn-success text-dark px-2 py-1 fw-bolder" data-bs-toggle="modal" data-bs-target="#createchothue">Thêm mới hóa đơn</button>
               
                    <!-- Search -->
                    <!-- /Search -->
                    <ul class="navbar-nav flex-row align-items-center ms-auto">
                        <!-- Place this tag where you want the button to render. -->
                        <li class="nav-item lh-1 me-3">
                            <span></span>
                        </li>
                        <!-- User -->
                        <li class="nav-item navbar-dropdown dropdown-user dropdown">
                            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                <div class="avatar avatar-online">
                                    <img src="/temp/img/avatars/1.png" alt="" class="w-px-40 h-auto rounded-circle">
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end position-absolute end-0" style="left:auto;">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar avatar-online">
                                                    <img src="/temp/img/avatars/1.png" alt="" class="w-px-40 h-auto rounded-circle">
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                                                <small class="text-muted">{{ Auth::user()->Role ? Auth::user()->Role->role_name : 'Chưa có' }}</small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="">
                                        <i class="bx bx-user me-2"></i>
                                        <span class="align-middle">My Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="bx bx-cog me-2"></i>
                                        <span class="align-middle">Settings</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                  <span class="d-flex align-items-center align-middle">
                  <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                  <span class="flex-grow-1 align-middle">Billing</span>
                  <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                  </span>
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                </li>
                                <li>
                                    <form id="form-logout" method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="button" class="dropdown-item fw-bold">
                                            <i class="lni lni-enter"></i>
                                            Đăng xuất
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                        <!--/ User -->
                    </ul>
                </div>
            </nav>
            <div class="modal fade" id="createchothue" tabindex="-1" aria-labelledby="createchothueLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="createchothueLabel">Thêm mới hóa đơn</h1>
                        </div>
                        <div class="card-body">
                            <div class="error">
                                @include('error')
                            </div>
                            <form id="form_chothue_store" class="form-create" method='POST' action='{{route('chothues.store')}}'>
                                @csrf
                                <div class='mb-3'>
                                    <label class='form-label' for='basic-default-name_customer'>Tên khách hàng</label>
                                    <input type='text' class='form-control input-field' id='name_customer' placeholder='Nhập tên khách hàng' name='name_customer' data-require='Mời nhập tên khách hàng' value="{{ old('name_customer') }}" />
                                </div>
                                <div class='mb-3'>
                                    <label class='form-label' for='basic-default-phone_number'>Số điện thoại</label>
                                    <input type='text' class='form-control input-field' id='phone_number' placeholder='Nhập số điện thoại' name='phone_number' data-require='Mời nhập số điện thoại' value="{{ old('phone_number') }}" />
                                </div>
                            
                                <div class='mb-3'>
                                    <label class='form-label' for='basic-default-so_ngay_thue'>Số ngày thuê</label>
                                    <div class="position-relative">
                                        <input type='number' class='form-control input-field' id='so_ngay_thue' placeholder='Nhập số ngày thuê' name='so_ngay_thue' data-require='Mời nhập số ngày thuê' value="{{ old('so_ngay_thue') }}" />
                                        {{-- <button type="button" class="btn btn-warning position-absolute top-0 end-0 bottom-0" id="updateTotalAmount">Cập nhật</button> <!-- Nút cập nhật tiền --> --}}
                                    </div>
                                </div>
                                <div class="form-group mb-3 product-item">
                                    <label for="product">Sản phẩm</label>
                                    <select class="form-control product-select" name="id_kho" id="id_product_theokho">
                                        @foreach($product_theokhos as $product_theokho)
                                            <option value="{{ $product_theokho->id }}" 
                                                    data-price="{{ $product_theokho->Product->price_1_day }}" 
                                                    data-available-quantity="{{ $product_theokho->available_quantity }}">
                                                {{ $product_theokho->Product->product_name }} - {{ $product_theokho->title }} 
                                                (Còn lại: {{ $product_theokho->available_quantity }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="number" name="soluongconlai" id="soluongconlai" value="" hidden>
                                    <input type="number" placeholder="Số lượng" id="quantity" name="quantity" class="form-control quantity-input mt-2 input-field" data-require="Mời nhập số lượng" />
                                    <span class="text-danger d-none error-message">Số lượng nhập vào vượt quá số lượng còn lại!</span>
                                </div>
                                
                                <div class='mb-3'>
                                    <label class='form-label' for='basic-default-thanh_tien'>Thành tiền</label>
                                    <input type='number' step="0.01" class='form-control d-none' id='thanh_tien_input' placeholder='Thành tiền' name='thanh_tien' readonly />
                                    <h3 class="fw-bold text-info" id="thanh_tien"></h3>
                                </div>
                            
                                <div class='mb-3'>
                                    <label class='form-label' for='basic-default-khach_coc'>Khách cọc</label>
                                    <input type='number' step="0.01" class='form-control input-field' id='khach_coc' placeholder='Nhập số tiền khách cọc' name='khach_coc' data-require='Mời nhập số tiền khách cọc' value="{{ old('khach_coc') }}" />
                                </div>
                            
                                <div class="modal-footer">
                                    <button type='submit' id="btn-themmoi" class='btn btn-success fw-semibold text-dark'>Thêm mới</button>
                                    <button type="button" class="btn btn-secondary fw-semibold" data-bs-dismiss="modal">Đóng</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @yield('contents')
        </div>
        <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->

</script>

@include('footer')


</body>
</html>
