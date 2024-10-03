@extends('main')
@section('contents')

    <div class="container-fluid flex-grow-1 container-p-y">
        <h3 class="fw-bold text-primary py-3 mb-4">{{$title}}</h3>
        <div class="card">
            <div class="d-flex p-4 justify-content-between">
                <h5 class=" fw-bold">Danh sách danh mục  </h5>
                <button type="button" data-id="" class="btn btn-success text-dark px-2 py-1 fw-bolder" data-bs-toggle="modal" data-bs-target="#createcategory">Thêm mới</button>
            </div>
            <div class="modal fade" id="createcategory" tabindex="-1" aria-labelledby="createcategoryLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="createcategoryLabel">Thêm mới Danh mục.</h1>
                        </div>
                        <div class="card-body">
                            <div class="error">
                                @include('error')
                            </div>
                            <form id="form_category_store" class="form-create" method='POST' action='{{route('categories.store')}}'>
                                @csrf
                                <div class='mb-3'>
                                    <label
                                        class='form-label'
                                        for='basic-default-fullname'
                                    >Tên danh mục</label>
                                    <input
                                        type='text'
                                        class='form-control name input-field '
                                        id='cate_name'
                                        placeholder='Nhập Tên danh mục'
                                        name='cate_name' data-require='Mời nhập Tên danh mục'
                                        value="{{ old('cate_name') }}"
                                    />
                                </div>
                                <div class='mb-3'>
                                    <label
                                        class='form-label'
                                        for='basic-default-fullname'
                                    >Mô tả</label>
                                    <input
                                        type='text'
                                        class='form-control name'
                                        id='desc'
                                        placeholder='Nhập mô tả'
                                        name='desc'
                                        value="{{ old('desc') }}"
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
                        <th>ID Danh mục</th>
                        <th>Tên danh mục</th>
                        <th>Mô tả</th>
                        <th>Thời gian tạo</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($categories as $category)
                        <tr data-id="{{$category->id}}">
                            <td> {{ $loop->iteration }}</td>
                            <td>{{$category->id}}</td>
                            <td>{{$category->cate_name}}</td>
                            <td>{{$category->desc}}</td>
                            <td>{{$category->updated_at}}</td>
                            <td class="">
                                    <button type="button" data-url="/categories/{{$category->id}}" data-id="{{$category->id}}" class="btn btn-danger btnDeleteAsk px-2 me-2 py-1 fw-bolder" data-bs-toggle="modal" data-bs-target="#deleteModal{{$category->id}}">Xóa</button>
                                    <button type="button" data-id="{{$category->id}}" class="btn btn-edit btnEditCategory btn-info text-dark px-2 py-1 fw-bolder">Sửa</button>
                            </td>

                            <!-- Modal Delete -->
                            <div class="modal fade" id="deleteModal{{$category->id}}" tabindex="-1" aria-labelledby="deleteModal{{$category->id}}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 text-wrap" id="deleteModal{{$category->id}}Label">Bạn có chắc chắn xóa Danh mục <b><u>{{$category->cate_name}}</u></b>  không ?</h1>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="delete-forever btn btn-danger" data-id="{{ $category->id }}">Xóa</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
                <div class="modal fade ModelEditCategory" id="editCategory" tabindex="-1" aria-labelledby="editCategoryLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-danger" id="createCategoryLabel"> </h1>
                            </div>
                            <div class="card-body">
                                <form method='post' action='' enctype="multipart/form-data" class="editCategoryForm form-edit" id="form_categoryAdmin_update">
                                    @method('PATCH')
                                    @csrf
                                    <div class='mb-3'>
                                        <label
                                            class='form-label'
                                            for='basic-default-fullname'
                                        >Tên danh mục</label>
                                        <input
                                            type='text'
                                            class='form-control cate_name input-field '
                                            id='cate_name-edit'
                                            placeholder='Nhập Tên danh mục'
                                            name='cate_name' data-require='Mời nhập Tên danh mục'
                                        />
                                    </div>
                                    <div class='mb-3'>
                                        <label
                                            class='form-label'
                                            for='basic-default-fullname'
                                        >Mô tả</label>
                                        <input
                                            type='text'
                                            class='form-control name'
                                            id='desc-edit'
                                            placeholder='Nhập mô tả'
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
                
                <div class="pagination mt-4 pb-4">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            if ($('#createcategory .alert-error').length > 0) {
                // Nếu có, hiển thị modal
                $('#createcategory').modal('show');
            }
            $('.btnEditCategory').on('click', function() {
                var categoryID = $(this).data('id'); // Lấy ID từ nút Sửa
                const ModelEdit = $('.ModelEditCategory');
                const editCategory = ModelEdit.attr('id', 'editCategory'+categoryID);
                const IdEditCategory = editCategory.attr('id');

                $.ajax({
                    url: '/categories/' + categoryID, // URL API để lấy thông tin Danh mục
                    type: 'GET',
                    success: function(response) {
                        // Cập nhật các trường dữ liệu trong modal
                        $('#'+IdEditCategory + ' #cate_name-edit').val(response.cate_name);
                        $('#'+IdEditCategory + ' .modal-title').text('Chỉnh sửa Danh mục: ' + response.cate_name);
                        $('#'+IdEditCategory + ' #desc-edit').val(response.desc);
                        $('#form_categoryAdmin_update').attr('action', '/categories/' + categoryID); // Cập nhật URL của form để sử dụng cho việc cập nhật
                        $(editCategory).modal('show'); // Hiển thị modal
                    },
                    error: function() {
                        alert('Không thể lấy dữ liệu khách hàng!');
                    }
                });
            });

        });
    </script>
@endsection
