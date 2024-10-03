@extends('main')
@section('contents')

    <div class="container-fluid flex-grow-1 container-p-y">
        <h3 class="fw-bold text-primary py-3 mb-4">{{$title}}</h3>
        <div class="card">
            <div class="d-flex p-4 justify-content-between">
                <h5 class=" fw-bold">Tài khoản quản trị </h5>
                <button type="button" data-id="" class="btn btn-success text-dark px-2 py-1 fw-bolder" data-bs-toggle="modal" data-bs-target="#createuser">Thêm mới</button>
            </div>
            <div class="modal fade" id="createuser" tabindex="-1" aria-labelledby="createuserLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="createuserLabel">Thêm mới người dùng.</h1>
                        </div>
                        <div class="card-body">
                            <div class="error">
                                @include('error')
                            </div>
                            <form id="form_user_store" class="form-create" method='POST' action='{{route('users.store')}}'>
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
                    @foreach($users as $user)
                        <tr data-id="{{$user->id}}">
                            <td> {{ $loop->iteration }}</td>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone_number}}</td>
                            <td>{{$user->Role->role_name ?? 'Chưa cấp quyền'}}</td>
                            <td>{{$user->updated_at}}</td>
                            @if(auth()->user()->role->isAdmin())
                                <td class="">
                                        <button type="button" data-url="/users/{{$user->id}}" data-id="{{$user->id}}" class="btn btn-danger btnDeleteAsk px-2 me-2 py-1 fw-bolder" data-bs-toggle="modal" data-bs-target="#deleteModal{{$user->id}}">Xóa</button>
                                        <button type="button" data-id="{{$user->id}}" class="btn btn-edit btnEditUser btn-info text-dark px-2 py-1 fw-bolder">Sửa</button>
                                    </td>
                            @endif

                            <!-- Modal Delete -->
                            <div class="modal fade" id="deleteModal{{$user->id}}" tabindex="-1" aria-labelledby="deleteModal{{$user->id}}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 text-wrap" id="deleteModal{{$user->id}}Label">Bạn có chắc chắn xóa người dùng <b><u>{{$user->name}}</u></b>  không ?</h1>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="delete-forever btn btn-danger" data-id="{{ $user->id }}">Xóa</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
                <div class="modal fade ModelEditUser" id="editUser" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-danger" id="createUserLabel"> </h1>
                            </div>
                            <div class="card-body">
                                <form method='post' action='' enctype="multipart/form-data" class="editUserForm form-edit" id="form_userAdmin_update">
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
                    {{ $users->links() }}
                </div>
               
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            if ($('#createuser .alert-error').length > 0) {
                // Nếu có, hiển thị modal
                $('#createuser').modal('show');
            }
            $('.btnEditUser').on('click', function() {
                var userID = $(this).data('id'); // Lấy ID từ nút Sửa
                const ModelEdit = $('.ModelEditUser');
                const editUser = ModelEdit.attr('id', 'editUser'+userID);
                const IdEditUser = editUser.attr('id');

                $.ajax({
                    url: '/users/' + userID, // URL API để lấy thông tin người dùng
                    type: 'GET',
                    success: function(response) {
                        // Cập nhật các trường dữ liệu trong modal
                        $('#'+IdEditUser + ' #name-edit').val(response.name);
                        $('#'+IdEditUser + ' .modal-title').text('Chỉnh sửa người dùng: ' + response.name);
                        $('#'+IdEditUser + ' #email-edit').val(response.email);
                        $('#'+IdEditUser + ' #phone_number-edit').val(response.phone_number);
                        $('#'+IdEditUser + ' #password-edit').val("");
                        $('#'+IdEditUser + ' #role-edit').val(response.role_id);

                        $('#form_userAdmin_update').attr('action', '/users/' + userID); // Cập nhật URL của form để sử dụng cho việc cập nhật
                        $(editUser).modal('show'); // Hiển thị modal
                    },
                    error: function() {
                        alert('Không thể lấy dữ liệu người dùng!');
                    }
                });
            });

        });
    </script>
@endsection

