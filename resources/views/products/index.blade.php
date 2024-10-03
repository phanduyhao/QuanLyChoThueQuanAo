@extends('main')
@section('contents')

    <div class="container-fluid flex-grow-1 container-p-y">
        <h3 class="fw-bold text-primary py-3 mb-4">{{$title}}</h3>
        <div class="card">
            <div class="d-flex p-4 justify-content-between">
                <h5 class=" fw-bold">Danh sách sản phẩm</h5>
                <button type="button" data-id="" class="btn btn-success text-dark px-2 py-1 fw-bolder" data-bs-toggle="modal" data-bs-target="#createproduct">Thêm mới</button>
            </div>
            <div class="modal fade" id="createproduct" tabindex="-1" aria-labelledby="createproductLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="createproductLabel">Thêm mới sản phẩm.</h1>
                        </div>
                        <div class="card-body">
                            <div class="error">
                                @include('error')
                            </div>
                            <form id="form_product_store" class="form-create" enctype="multipart/form-data" method='POST' action='{{route('products.store')}}'>
                                @csrf
                                <div class="mb-3 d-flex flex-column image-gallery" id="image-gallery-form_product_store">
                                    <label
                                        class='form-label'
                                        for='basic-default-fullname'
                                    >Ảnh</label>
                                    <input type="file" name="image" class="file-input" id="file-input-form_product_store" multiple onchange="previewImages(event, 'form_product_store')">
                                    <div class="image-preview" id="image-preview-form_product_store"></div>
                                </div>
                                <div class='mb-3'>
                                    <label class='form-label' for='product_name'>Tên sản phẩm</label>
                                    <input type='text' class='form-control input-field' id='product_name' name='product_name' data-require='Mời nhập Tên sản phẩm' placeholder='Nhập tên sản phẩm' value="{{ old('product_name') }}" />
                                </div>
                                <div class='mb-3'>
                                    <label class='form-label' for='size'>Size</label>
                                    <input type='text' class='form-control' id='size' name='size' placeholder='Nhập size' value="{{ old('size') }}" />
                                </div>
                                <div class='mb-3'>
                                    <label class='form-label' for='price_1_day '>Giá / Ngày</label>
                                    <input type='number' class='form-control input-field' id='price_1_day' name='price_1_day' data-require='Mời nhập giá 1 ngày' placeholder='Nhập giá / ngày' value="{{ old('price_1_day') }}" />
                                </div>
                                <div class='mb-3'>
                                    <label class='form-label' for='quantity_origin'>Số lượng ban đầu</label>
                                    <input type='number' class='form-control' id='quantity_origin' name='quantity_origin' placeholder='Nhập số lượng ban đầu' value="{{ old('quantity_origin') }}" />
                                </div>
                                <div class='mb-3'>
                                    <label class='form-label' for='cate_id'>Danh mục</label>
                                    <select name="cate_id" class="form-control" id="cate_id">
                                        <option value="">Chọn danh mục</option>
                                        @foreach($cates as $cate)
                                            <option value="{{ $cate->id }}">{{ $cate->cate_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success fw-semibold text-dark">Thêm mới</button>
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
                        <th>ID sản phẩm</th>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Size</th>
                        <th>Giá / Ngày</th>
                        <th>Số lượng ban đầu</th>
                        <th>Danh mục</th>
                        <th>Thời gian</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($products as $product)
                        <tr data-id="{{$product->id}}">
                            <td> {{ $loop->iteration }}</td>
                            <td>{{$product->id}}</td>
                            <td>
                                <img width="100" src="/temp/images/product/{{$product->image}}" alt="{{ $product->product_name }}'s Thumb">
                            </td>
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->size}}</td>
                            <td>{{$product->price_1_day}}</td>
                            <td>{{$product->quantity_origin}}</td>
                            <td>{{$product->Category->cate_name ?? 'Chưa có Danh mục'}}</td>
                            <td>{{$product->updated_at}}</td>
                            <td class="">
                                    <button type="button" data-url="/products/{{$product->id}}" data-id="{{$product->id}}" class="btn btn-danger btnDeleteAsk px-2 me-2 py-1 fw-bolder" data-bs-toggle="modal" data-bs-target="#deleteModal{{$product->id}}">Xóa</button>
                                    <button type="button" data-id="{{$product->id}}" class="btn btn-edit btnEditProduct btn-info text-dark px-2 py-1 fw-bolder">Sửa</button>
                            </td>

                            <!-- Modal Delete -->
                            <div class="modal fade" id="deleteModal{{$product->id}}" tabindex="-1" aria-labelledby="deleteModal{{$product->id}}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 text-wrap" id="deleteModal{{$product->id}}Label">Bạn có chắc chắn xóa sản phẩm <b><u>{{$product->product_name}}</u></b>  không ?</h1>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="delete-forever btn btn-danger" data-id="{{ $product->id }}">Xóa</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="modal fade ModelEditProduct" id="editProduct" tabindex="-1" aria-labelledby="editProductLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-danger" id="createProductLabel"> </h1>
                            </div>
                            <div class="card-body">
                                <form method='post' action='' enctype="multipart/form-data" class="editProductForm form-edit" id="form_productAdmin_update">
                                    @method('PATCH')
                                    @csrf
                                    <div class="mb-3 d-flex flex-column image-gallery" id="image-gallery-{{$product->id}}">
                                        <label
                                            class='form-label'
                                            for='basic-default-fullname'
                                        >Ảnh</label>
                                        <input type="file" name="image" class="file-input" id="file-input-{{$product->id}}" multiple onchange="previewImages(event, {{$product->id}})">
                                        <div class="image-preview" id="image-preview-{{$product->id}}"></div>
                                    </div>
                                    <div class='mb-3'>
                                        <label class='form-label' for='product_name_edit'>Tên sản phẩm</label>
                                        <input type='text' class='form-control input-field' id='product_name_edit' data-require='Mời nhập Tên sản phẩm' name='product_name' placeholder='Nhập tên sản phẩm' />
                                    </div>
                                    <div class='mb-3'>
                                        <label class='form-label' for='size_edit'>Size</label>
                                        <input type='text' class='form-control' id='size_edit' name='size' placeholder='Nhập size' />
                                    </div>
                                    <div class='mb-3'>
                                        <label class='form-label' for='price_1_day_edit'>Giá / Ngày</label>
                                        <input type='number' class='form-control input-field' id='price_1_day_edit' name='price_1_day' placeholder='Nhập giá / ngày' />
                                    </div>
                                    <div class='mb-3'>
                                        <label class='form-label' for='quantity_origin_edit'>Số lượng ban đầu</label>
                                        <input type='number' class='form-control' id='quantity_origin_edit' name='quantity_origin' placeholder='Nhập số lượng ban đầu' />
                                    </div>
                                    <div class='mb-3'>
                                        <label class='form-label' for='cate_id_edit'>Danh mục</label>
                                        <select name="cate_id" class="form-control" id="cate_id_edit">
                                            <option value="">Chọn danh mục</option>
                                            @foreach($cates as $cate)
                                                <option value="{{ $cate->id }}">{{ $cate->cate_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success fw-semibold text-dark">Cập nhật</button>
                                        <button type="button" class="btn btn-secondary fw-semibold" data-bs-dismiss="modal">Đóng</button>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="pagination mt-4 pb-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.btnEditProduct').on('click', function() {
                var productID = $(this).data('id'); // Lấy ID từ nút Sửa
                const ModelEdit = $('.ModelEditProduct');
                const editProduct = ModelEdit.attr('id', 'editProduct' + productID);
                const IdEditProduct = editProduct.attr('id');

                // Cập nhật các thuộc tính động cho các thẻ input và div
                $('#'+IdEditProduct + ' .image-gallery').attr("id", "image-gallery-" + productID);
                $('#'+IdEditProduct + ' .file-input').attr("id", "file-input-" + productID);
                $('#'+IdEditProduct + ' .image-preview').attr("id", "image-preview-" + productID);
                $('#file-input-' + productID).attr("onchange", "previewImages(event, " + productID + ")");

                // AJAX lấy dữ liệu sản phẩm
                $.ajax({
                    url: '/products/' + productID, // URL API để lấy thông tin sản phẩm
                    type: 'GET',
                    success: function(response) {
                        // Cập nhật các trường dữ liệu trong modal
                        $('#'+IdEditProduct + ' #product_name_edit').val(response.product_name);
                        $('#'+IdEditProduct + ' .modal-title').text('Chỉnh sửa sản phẩm: ' + response.product_name);
                        $('#'+IdEditProduct + ' #size_edit').val(response.size);
                        $('#'+IdEditProduct + ' #price_1_day_edit').val(response.price_1_day);
                        $('#'+IdEditProduct + ' #quantity_origin_edit').val(response.quantity_origin);
                        $('#'+IdEditProduct + ' #cate_id_edit').val(response.cate_id);

                        // Cập nhật URL của form để sử dụng cho việc cập nhật
                        $('#form_productAdmin_update').attr('action', '/products/' + productID);

                        // Hiển thị ảnh hiện tại
                        var previewContainer = $('#image-preview-' + productID);
                        previewContainer.empty(); // Xóa ảnh hiện tại (nếu có)
                        
                        if(response.image) {
                            // Thêm ảnh hiện tại vào container preview
                            var imgElement = $('<img>').attr('src', '/temp/images/product/' + response.image).css('max-width', '200px');
                            previewContainer.append(imgElement);
                        }

                        $(editProduct).modal('show'); // Hiển thị modal
                    },
                    error: function() {
                        alert('Không thể lấy dữ liệu sản phẩm!');
                    }
                });
            });
        });

    </script>
@endsection

