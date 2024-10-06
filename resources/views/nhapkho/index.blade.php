@extends('main')
@section('contents')

    <div class="container-fluid flex-grow-1 container-p-y">
        <h3 class="fw-bold text-primary py-3 mb-4">{{$title}}</h3>
        <div class="card">
            <div class="d-flex p-4 justify-content-between">
                <h5 class=" fw-bold">Nhập kho </h5>
                <button type="button" data-id="" class="btn btn-success text-dark px-2 py-1 fw-bolder" data-bs-toggle="modal" data-bs-target="#createnhapkho">Thêm mới</button>
            </div>
            <div class="modal fade" id="createnhapkho" tabindex="-1" aria-labelledby="createnhapkhoLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="createnhapkhoLabel">Thêm mới</h1>
                        </div>
                        <div class="card-body">
                            <div class="error">
                                @include('error')
                            </div>
                            <form id="form_nhapkho_store" class="form-create" method='POST' action='{{route('nhapkhos.store')}}'>
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
                                <div class='mb-3'>
                                    <label
                                        class='form-label'
                                        for='basic-default-company'
                                    >Mật khẩu</label>
                                    <input
                                        type='password'
                                        class='form-control password input-field'
                                        id='password-store'
                                        placeholder='Nhập số điện thoại'
                                        name='password' data-require='Mời nhập mật khẩu'
                                    />
                                </div>
                                <div class="form-group">
                                    <label class='form-label'
                                           for='basic-default-email'>Quyền</label>
                                    <select name="role_id" class="form-control" id="role">
                                        <option value="">Chọn quyền</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                        @endforeach
                                    </select>
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
                        <th>ID Người dùng</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Quyền</th>
                        <th>Thời gian tạo</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($nhapkhos as $nhapkho)
                        <tr data-id="{{$nhapkho->id}}">
                            <td> {{ $loop->iteration }}</td>
                            <td>{{$nhapkho->id}}</td>
                            <td>{{$nhapkho->name}}</td>
                            <td>{{$nhapkho->email}}</td>
                            <td>{{$nhapkho->phone_number}}</td>
                            <td>{{$nhapkho->Role->role_name ?? 'Chưa cấp quyền'}}</td>
                            <td>{{$nhapkho->updated_at}}</td>
                            @if(auth()->nhapkho()->role->isAdmin())
                                <td class="">
                                        <button type="button" data-url="/nhapkhos/{{$nhapkho->id}}" data-id="{{$nhapkho->id}}" class="btn btn-danger btnDeleteAsk px-2 me-2 py-1 fw-bolder" data-bs-toggle="modal" data-bs-target="#deleteModal{{$nhapkho->id}}">Xóa</button>
                                        <button type="button" data-id="{{$nhapkho->id}}" class="btn btn-edit btnEditNhapkho btn-info text-dark px-2 py-1 fw-bolder">Sửa</button>
                                    </td>
                            @endif

                            <!-- Modal Delete -->
                            <div class="modal fade" id="deleteModal{{$nhapkho->id}}" tabindex="-1" aria-labelledby="deleteModal{{$nhapkho->id}}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 text-wrap" id="deleteModal{{$nhapkho->id}}Label">Bạn có chắc chắn xóa người dùng <b><u>{{$nhapkho->name}}</u></b>  không ?</h1>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="delete-forever btn btn-danger" data-id="{{ $nhapkho->id }}">Xóa</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
                <div class="modal fade ModelEditNhapkho" id="editNhapkho" tabindex="-1" aria-labelledby="editNhapkhoLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-danger" id="createNhapkhoLabel"> </h1>
                            </div>
                            <div class="card-body">
                                <form method='post' action='' enctype="multipart/form-data" class="editNhapkhoForm form-edit" id="form_nhapkhoAdmin_update">
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
                                    <div class='mb-3'>
                                        <label
                                            class='form-label'
                                            for='basic-default-company'
                                        >Mật khẩu</label>
                                        <input
                                            type='password'
                                            class='form-control password'
                                            id='password-edit'
                                            placeholder='Nhập số điện thoại'
                                            name='password'
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label class='form-label'
                                               for='basic-default-email'>Quyền</label>
                                        <select name="role_id" class="form-control" id="role-edit">
                                            <option value="">Chọn quyền</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                            @endforeach
                                        </select>
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
                    {{ $nhapkhos->links() }}
                </div>
               
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            if ($('#createnhapkho .alert-error').length > 0) {
                // Nếu có, hiển thị modal
                $('#createnhapkho').modal('show');
            }
            $('.btnEditNhapkho').on('click', function() {
                var nhapkhoID = $(this).data('id'); // Lấy ID từ nút Sửa
                const ModelEdit = $('.ModelEditNhapkho');
                const editNhapkho = ModelEdit.attr('id', 'editNhapkho'+nhapkhoID);
                const IdEditNhapkho = editNhapkho.attr('id');

                $.ajax({
                    url: '/nhapkhos/' + nhapkhoID, // URL API để lấy thông tin người dùng
                    type: 'GET',
                    success: function(response) {
                        // Cập nhật các trường dữ liệu trong modal
                        $('#'+IdEditNhapkho + ' #name-edit').val(response.name);
                        $('#'+IdEditNhapkho + ' .modal-title').text('Chỉnh sửa người dùng: ' + response.name);
                        $('#'+IdEditNhapkho + ' #email-edit').val(response.email);
                        $('#'+IdEditNhapkho + ' #phone_number-edit').val(response.phone_number);
                        $('#'+IdEditNhapkho + ' #password-edit').val("");
                        $('#'+IdEditNhapkho + ' #role-edit').val(response.role_id);

                        $('#form_nhapkhoAdmin_update').attr('action', '/nhapkhos/' + nhapkhoID); // Cập nhật URL của form để sử dụng cho việc cập nhật
                        $(editNhapkho).modal('show'); // Hiển thị modal
                    },
                    error: function() {
                        alert('Không thể lấy dữ liệu người dùng!');
                    }
                });
            });

        });
    </script>
@endsection

