@extends('main')
@section('contents')
    <div class="container-fluid flex-grow-1 container-p-y">
        <h3 class="fw-bold text-primary py-3 mb-4">{{$title}}</h3>
        <div class="card">
            <div class="d-flex p-4 justify-content-between">
                <h5 class=" fw-bold">Danh sách quyền </h5>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>ID Quyền</th>
                        <th>Tên quyền</th>
                        <th>Mô tả</th>
                        <th>Thời gian tạo</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($roles as $role)
                        <tr data-id="{{$role->id}}">
                            <td> {{ $loop->iteration }}</td>
                            <td>{{$role->id}}</td>
                            <td>{{$role->role_name}}</td>
                            <td>{{$role->desc}}</td>
                            <td>{{$role->updated_at}}</td>
                            @if(auth()->user()->role->isAdmin())
                                <td class="">
                                        {{-- <button type="button" data-url="/roles/{{$role->id}}" data-id="{{$role->id}}" class="btn btn-danger btnDeleteAsk px-2 me-2 py-1 fw-bolder" data-bs-toggle="modal" data-bs-target="#deleteModal">Xóa</button> --}}
                                        <button type="button" data-id="{{$role->id}}" class="btn btn-edit btn-info btnEditUser text-dark px-2 py-1 fw-bolder" data-bs-toggle="modal" data-bs-target="#editUser{{$role->id}}">Sửa</button>
                                </td>
                            @endif
                            <!-- Modal Delete -->
                            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="deleteModalLabel">Bạn có chắc chắn xóa bản ghi này vĩnh viễn không ?</h1>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="delete-forever btn btn-danger" data-id="{{ $role->id }}">Xóa</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
                <!-- Modal Edit -->
                @foreach($roles as $role)
                <div class="modal fade" id="editUser{{$role->id}}" tabindex="-1" aria-labelledby="editUser{{$role->id}}Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="createUserLabel">Chỉnh sửa quyền. ID - {{$role->id}}</h1>
                            </div>
                            <div class="card-body">
                                <form method='post' action='{{ route('roles.update',['role' => $role]) }}' enctype="multipart/form-data" class="editUserForm form-edit" id="form_userAdmin_update-{{$role->id}}">
                                    @method('PATCH')
                                    @csrf
                                    <div class='mb-3'>
                                        <label
                                            class='form-label'
                                            for='basic-default-fullname'
                                        >Tên Quyền</label>
                                        <input
                                            type='text'
                                            class='form-control input-field'
                                            id='role_name-{{$role->id}}'
                                            value="{{$role->role_name}}"
                                            placeholder='Nhập tên'
                                            name='role_name' data-require='Mời nhập tên'
                                        />
                                    </div>
                                    <div class='mb-3'>
                                        <label
                                            class='form-label'
                                            for='basic-default-company'
                                        >Mô tả</label>
                                        <input
                                            type='text'
                                            class='form-control'
                                            id='desc-{{$role->id}}'
                                            value="{{$role->desc}}"
                                            placeholder='Nhập Mô tả'
                                            name='desc'
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
                @endforeach
            </div>
        </div>
    </div>
@endsection
