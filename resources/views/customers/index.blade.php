@extends('main')
@section('contents')

    <div class="container-fluid flex-grow-1 container-p-y">
        <h3 class="fw-bold text-primary py-3 mb-4">{{$title}}</h3>
        <div>
            <form class="form-search" method="GET" action="{{ route('customers.index') }}">
                @csrf
                <div class="d-flex align-items-center mb-4">
                    <h4 class="ten-game me-3 mb-0">Tìm kiếm</h4>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12 mb-3">
                            <input class="form-control shadow-none" type="number" name="search_id" placeholder="Tìm theo mã số..." value="{{ request('search_id') }}">
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12 mb-3">
                            <input class="form-control shadow-none" type="text" name="search_name" placeholder="Tìm theo tên..." value="{{ request('search_name') }}">
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12 mb-3">
                            <input class="form-control shadow-none" type="text" name="search_email" placeholder="Tìm theo email..." value="{{ request('search_email') }}">
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12 mb-3">
                            <input class="form-control shadow-none" type="text" name="search_phone" placeholder="Tìm theo số điện thoại..." value="{{ request('search_phone') }}">
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12 mb-3">
                            <div class="text-nowrap">
                                <button type="submit" class="btn btn-danger rounded-pill"><i class="fas fa-search me-2"></i>Tìm kiếm</button>
                                <a href="{{ route('customers.index') }}" class="btn btn-secondary rounded-pill ms-2"><i class="fas fa-times me-2"></i>Xóa lọc</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card">
            <div class="d-flex p-4 justify-content-between">
                <h5 class=" fw-bold">Tài khoản khách hàng </h5>
                <button type="button" data-id="" class="btn btn-success text-dark px-2 py-1 fw-bolder" data-bs-toggle="modal" data-bs-target="#createcustomer">Thêm mới</button>
            </div>
            <div class="modal fade" id="createcustomer" tabindex="-1" aria-labelledby="createcustomerLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="createcustomerLabel">Thêm mới khách hàng.</h1>
                        </div>
                        <div class="card-body">
                            <div class="error">
                                @include('error')
                            </div>
                            <form id="form_customer_store" class="form-create" method='POST' action='{{route('customers.store')}}'>
                                @csrf
                                <div class='mb-3'>
                                    <label
                                        class='form-label'
                                        for='basic-default-fullname'
                                    >Họ tên</label>
                                    <input
                                        type='text'
                                        class='form-control name input-field '
                                        id='name'
                                        placeholder='Nhập họ tên'
                                        name='name' data-require='Mời nhập họ tên'
                                        value="{{ old('name') }}"
                                    />
                                </div>
                                <div class='mb-3'>
                                    <label
                                        class='form-label'
                                        for='basic-default-company'
                                    >Email</label>
                                    <input
                                        type='email'
                                        class='form-control email input-field'
                                        id='email-store'
                                        placeholder='Nhập Email'
                                        name='email' data-require='Mời nhập email'
                                        value="{{ old('email') }}"
                                    />
                                </div>
                                <div class='mb-3'>
                                    <label
                                        class='form-label'
                                        for='basic-default-company'
                                    >Số điện thoại</label>
                                    <input
                                        type='phone_number'
                                        class='form-control phone_number input-field'
                                        id='phone_number-store'
                                        placeholder='Nhập số điện thoại'
                                        name='phone_number' data-require='Mời nhập số điện thoại'
                                        value="{{ old('phone_number') }}"
                                    />
                                </div>
                                <div class="modal-footer">
                                    <button type='submit' class='btn btn-success fw-semibold text-dark'>Thêm mới</button>
                                    <button type="button" class="btn btn-secondary fw-semibold" data-bs-dismiss="modal">Đóng</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>ID khách hàng</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Thời gian tạo</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($customers as $customer)
                        <tr data-id="{{$customer->id}}">
                            <td> {{ $loop->iteration }}</td>
                            <td>{{$customer->id}}</td>
                            <td>{{$customer->name}}</td>
                            <td>{{$customer->email}}</td>
                            <td>{{$customer->phone_number}}</td>
                            <td>{{$customer->updated_at}}</td>
                            <td class="">
                                @if(auth()->user()->role->isAdmin())
                                <button type="button" data-url="/customers/{{$customer->id}}" data-id="{{$customer->id}}" class="btn btn-danger btnDeleteAsk px-2 me-2 py-1 fw-bolder" data-bs-toggle="modal" data-bs-target="#deleteModal{{$customer->id}}">Xóa</button>
                                @endif
                                <button type="button" data-id="{{$customer->id}}" class="btn btn-edit btnEditCustomer btn-info text-dark px-2 py-1 fw-bolder">Sửa</button>
                            </td>

                            <!-- Modal Delete -->
                            <div class="modal fade" id="deleteModal{{$customer->id}}" tabindex="-1" aria-labelledby="deleteModal{{$customer->id}}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 text-wrap" id="deleteModal{{$customer->id}}Label">Bạn có chắc chắn xóa khách hàng <b><u>{{$customer->name}}</u></b>  không ?</h1>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="delete-forever btn btn-danger" data-id="{{ $customer->id }}">Xóa</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
                <div class="modal fade ModelEditCustomer" id="editCustomer" tabindex="-1" aria-labelledby="editCustomerLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-danger" id="createCustomerLabel"> </h1>
                            </div>
                            <div class="card-body">
                                <form method='post' action='' enctype="multipart/form-data" class="editCustomerForm form-edit" id="form_customerAdmin_update">
                                    @method('PATCH')
                                    @csrf
                                    <div class='mb-3'>
                                        <label
                                            class='form-label'
                                            for='basic-default-fullname'
                                        >Họ tên</label>
                                        <input
                                            type='text'
                                            class='form-control name input-field '
                                            id='name-edit'
                                            placeholder='Nhập họ tên'
                                            name='name' data-require='Mời nhập họ tên'
                                        />
                                    </div>
                                    <div class='mb-3'>
                                        <label
                                            class='form-label'
                                            for='basic-default-company'
                                        >Email</label>
                                        <input
                                            type='email'
                                            class='form-control email input-field'
                                            id='email-edit'
                                            placeholder='Nhập Email'
                                            name='email' data-require='Mời nhập email'
                                        />
                                    </div>
                                    <div class='mb-3'>
                                        <label
                                            class='form-label'
                                            for='basic-default-company'
                                        >Số điện thoại</label>
                                        <input
                                            type='phone_number'
                                            class='form-control phone_number input-field'
                                            id='phone_number-edit'
                                            placeholder='Nhập số điện thoại'
                                            name='phone_number' data-require='Mời nhập số điện thoại'
                                        />
                                    </div>
                                    
                                    <div class="modal-footer">
                                        <button type='submit' class='btn btn-success fw-semibold text-dark'>Cập nhật</button>
                                        <button type="button" class="btn btn-secondary fw-semibold" data-bs-dismiss="modal">Đóng</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="pagination mt-4 pb-4">
                    {{ $customers->links() }}
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            if ($('#createcustomer .alert-error').length > 0) {
                // Nếu có, hiển thị modal
                $('#createcustomer').modal('show');
            }
            $('.btnEditCustomer').on('click', function() {
                var customerID = $(this).data('id'); // Lấy ID từ nút Sửa
                const ModelEdit = $('.ModelEditCustomer');
                const editCustomer = ModelEdit.attr('id', 'editCustomer'+customerID);
                const IdEditCustomer = editCustomer.attr('id');

                $.ajax({
                    url: '/customers/' + customerID, // URL API để lấy thông tin khách hàng
                    type: 'GET',
                    success: function(response) {
                        // Cập nhật các trường dữ liệu trong modal
                        $('#'+IdEditCustomer + ' #name-edit').val(response.name);
                        $('#'+IdEditCustomer + ' .modal-title').text('Chỉnh sửa khách hàng: ' + response.name);
                        $('#'+IdEditCustomer + ' #email-edit').val(response.email);
                        $('#'+IdEditCustomer + ' #phone_number-edit').val(response.phone_number);
                        $('#form_customerAdmin_update').attr('action', '/customers/' + customerID); // Cập nhật URL của form để sử dụng cho việc cập nhật
                        $(editCustomer).modal('show'); // Hiển thị modal
                    },
                    error: function() {
                        alert('Không thể lấy dữ liệu khách hàng!');
                    }
                });
            });

        });
    </script>
@endsection

