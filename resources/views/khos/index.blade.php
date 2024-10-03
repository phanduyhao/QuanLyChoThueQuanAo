@extends('main')
@section('contents')

    <div class="container-fluid flex-grow-1 container-p-y">
        <h3 class="fw-bold text-primary py-3 mb-4">{{$title}}</h3>
        <div class="card">
            <div class="d-flex p-4 justify-content-between">
                <h5 class=" fw-bold">Danh sách kho</h5>
                <button type="button" data-id="" class="btn btn-success text-dark px-2 py-1 fw-bolder" data-bs-toggle="modal" data-bs-target="#createkho">Thêm mới</button>
            </div>
            <div class="modal fade" id="createkho" tabindex="-1" aria-labelledby="createkhoLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="createkhoLabel">Thêm mới kho.</h1>
                        </div>
                        <div class="card-body">
                            <div class="error">
                                @include('error')
                            </div>
                            <form id="form_kho_store" class="form-create" method='POST' action='{{route('khos.store')}}'>
                                @csrf
                                <div class='mb-3'>
                                    <label
                                        class='form-label'
                                        for='basic-default-fullname'
                                    >Tên kho</label>
                                    <input
                                        type='text'
                                        class='form-control name input-field '
                                        id='title'
                                        placeholder='Nhập tên kho'
                                        name='title' data-require='Mời nhập tên kho'
                                        value="{{ old('title') }}"
                                    />
                                </div>
                                <div class="form-group mb-3">
                                    <label class='form-label'for='basic-default-email'>Sản phẩm</label>
                                    <select name="id_product" class="form-control input-field" id="product" data-require="Mời chọn sản phẩm">
                                        <option value="">Chọn sản phẩm</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class='mb-3'>
                                    <label
                                        class='form-label'
                                        for='basic-default-company'
                                    >Số lượng</label>
                                    <input
                                        type='number'
                                        class='form-control quantity input-field'
                                        id='quantity-store'
                                        placeholder='Nhập số lượng'
                                        name='quantity' data-require='Mời nhập số lượng'
                                        value="{{ old('quantity') }}"
                                    />
                                </div>
                                <div class='mb-3'>
                                    <label
                                        class='form-label'
                                        for='basic-default-company'
                                    >Mô tả</label>
                                    <input
                                        type='text'
                                        class='form-control desc'
                                        id='desc-store'
                                        placeholder='Nhập mô tả'
                                        name='desc'
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
                        <th>ID Kho</th>
                        <th>Tên kho</th>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Mô tả</th>
                        <th>Thời gian</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($khos as $kho)
                        <tr data-id="{{$kho->id}}">
                            <td> {{ $loop->iteration }}</td>
                            <td>{{$kho->id}}</td>
                            <td>{{$kho->title}}</td>
                            <td>{{$kho->Product->product_name??"Chưa có sản phẩm"}}</td>
                            <td>{{$kho->quantity}}</td>
                            <td>{{$kho->desc}}</td>
                            <td>{{$kho->updated_at}}</td>
                            <td class="">
                                    <button type="button" data-url="/khos/{{$kho->id}}" data-id="{{$kho->id}}" class="btn btn-danger btnDeleteAsk px-2 me-2 py-1 fw-bolder" data-bs-toggle="modal" data-bs-target="#deleteModal{{$kho->id}}">Xóa</button>
                                    <button type="button" data-id="{{$kho->id}}" class="btn btn-edit btnEditKho btn-info text-dark px-2 py-1 fw-bolder">Sửa</button>
                            </td>

                            <!-- Modal Delete -->
                            <div class="modal fade" id="deleteModal{{$kho->id}}" tabindex="-1" aria-labelledby="deleteModal{{$kho->id}}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 text-wrap" id="deleteModal{{$kho->id}}Label">Bạn có chắc chắn xóa kho <b><u>{{$kho->title}}</u></b>  không ?</h1>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="delete-forever btn btn-danger" data-id="{{ $kho->id }}">Xóa</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
                <div class="modal fade ModelEditKho" id="editKho" tabindex="-1" aria-labelledby="editKhoLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-danger" id="createKhoLabel"> </h1>
                            </div>
                            <div class="card-body">
                                <form method='post' action='' enctype="multipart/form-data" class="editKhoForm form-edit" id="form_khoAdmin_update">
                                    @method('PATCH')
                                    @csrf
                                    <div class='mb-3'>
                                        <label
                                            class='form-label'
                                            for='basic-default-fullname'
                                        >Tên kho</label>
                                        <input
                                            type='text'
                                            class='form-control title input-field'
                                            id='title-edit'
                                            placeholder='Nhập tên kho'
                                            name='title' data-require='Mời nhập tên kho'
                                        />
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class='form-label' for='basic-default-email'>Sản phẩm</label>
                                        <select name="id_product" class="form-control input-field" id="product-edit" data-require="Mời chọn sản phẩm">
                                            <option value="">Chọn sản phẩm</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class='mb-3'>
                                        <label
                                            class='form-label'
                                            for='basic-default-company'
                                        >Số lượng</label>
                                        <input
                                            type='number'
                                            class='form-control quantity input-field'
                                            id='quantity-edit'
                                            placeholder='Nhập số lượng'
                                            name='quantity' data-require='Mời nhập số lượng'
                                        />
                                    </div>
                                    <div class='mb-3'>
                                        <label
                                            class='form-label'
                                            for='basic-default-company'
                                        >Mô tả</label>
                                        <input
                                            type='text'
                                            class='form-control desc'
                                            id='desc-edit'
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
                    {{ $khos->links() }}
                </div>
               
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            if ($('#createkho .alert-error').length > 0) {
                // Nếu có, hiển thị modal
                $('#createkho').modal('show');
            }
            $('.btnEditKho').on('click', function() {
                var khoID = $(this).data('id'); // Lấy ID từ nút Sửa
                const ModelEdit = $('.ModelEditKho');
                const editKho = ModelEdit.attr('id', 'editKho'+khoID);
                const IdEditKho = editKho.attr('id');

                $.ajax({
                    url: '/khos/' + khoID, // URL API để lấy thông tin kho
                    type: 'GET',
                    success: function(response) {
                        // Cập nhật các trường dữ liệu trong modal
                        $('#'+IdEditKho + ' #title-edit').val(response.title);
                        $('#'+IdEditKho + ' .modal-title').text('Chỉnh sửa kho: ' + response.title);
                        $('#'+IdEditKho + ' #desc-edit').val(response.desc);
                        $('#'+IdEditKho + ' #quantity-edit').val(response.quantity);
                        $('#'+IdEditKho + ' #product-edit').val(response.id_product);

                        $('#form_khoAdmin_update').attr('action', '/khos/' + khoID); // Cập nhật URL của form để sử dụng cho việc cập nhật
                        $(editKho).modal('show'); // Hiển thị modal
                    },
                    error: function() {
                        alert('Không thể lấy dữ liệu kho!');
                    }
                });
            });

        });
    </script>
@endsection

