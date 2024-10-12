@extends('main')
@section('contents')

    <div class="container-fluid flex-grow-1 container-p-y">
        <h3 class="fw-bold text-primary py-3 mb-4">{{$title}}</h3>
        <div class="card">
            <div class="card-body">
                <div class="error">
                    @include('error')
                </div>
                <form class="form-create" method='POST' action='{{route('update')}}'>
                    @csrf
                    @method('PATCH')
                    <div class='mb-3'>
                        <label
                            class='form-label'
                            for='basic-default-fullname'
                        >Tên cửa hàng</label>
                        <input
                            type='text'
                            class='form-control name input-field '
                            placeholder='Nhập Tên cửa hàng'
                            name='ten_cua_hang'
                            value="{{ $tencuahang }}"
                        />
                    </div>
                    <div class='mb-3'>
                        <label
                            class='form-label'
                            for='basic-default-fullname'
                        >Số điện thoại</label>
                        <input
                            type='text'
                            class='form-control name'
                            placeholder='Nhập số điện thoại'
                            name='sdt'
                            value="{{ $sdt }}"

                        />
                    </div>
                    <div class='mb-3'>
                        <label
                            class='form-label'
                            for='basic-default-fullname'
                        >Số tài khoản ngân hàng</label>
                        <input
                            type='text'
                            class='form-control name'
                            placeholder='Nhập số tài khoản'
                            name='stk'
                            value="{{ $stk }}"

                        />
                    </div>
                    <div class='mb-3'>
                        <label
                            class='form-label'
                            for='basic-default-fullname'
                        >Link Mã QR CODE</label>
                        <input
                            type='text'
                            class='form-control name'
                            placeholder='Nhập link mã qr'
                            name='link_qr_code'
                            value="{{ $link_qr }}"

                        />
                    </div>
                    <div class='mb-3'>
                        <label
                            class='form-label'
                            for='basic-default-fullname'
                        >Địa chỉ</label>
                        <input
                            type='text'
                            class='form-control name'
                            placeholder='Nhập địa chỉ'
                            name='dia_chi'
                            value="{{ $dia_chi }}"

                        />
                    </div>
                    <div class='mb-3'>
                        <label
                            class='form-label'
                            for='basic-default-fullname'
                        >Ghi chú</label>
                        <input
                            type='text'
                            class='form-control name'
                            placeholder='Nhập ghi chú'
                            name='ghi_chu'
                            value="{{ $ghi_chu }}"

                        />
                    </div>
                    <div class="">
                        <button type='submit' class='btn btn-success fw-semibold text-dark'>Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

