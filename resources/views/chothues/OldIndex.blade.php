@extends('main')
@section('contents')

    <div class="container-fluid flex-grow-1 container-p-y">
        <h3 class="fw-bold text-primary py-3 mb-4">{{$title}}</h3>
        <div class="card">
            <div class="d-flex p-4 justify-content-between">
                <h5 class=" fw-bold">Danh sách thông tin cho thuê sản phẩm</h5>
                <button type="button" data-id="" class="btn btn-success text-dark px-2 py-1 fw-bolder" data-bs-toggle="modal" data-bs-target="#createchothue">Thêm mới hóa đơn</button>
            </div>
          <!-- Modal chính -->
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
                                        <button type="button" class="btn btn-warning position-absolute top-0 end-0 bottom-0" id="updateTotalAmount">Cập nhật</button> <!-- Nút cập nhật tiền -->
                                    </div>
                                </div>
                                

                                <!-- Nơi sản phẩm được hiển thị -->
                                <div id="product-wrapper"></div>

                                <button type="button" class="btn btn-primary mb-3" id="openAddProductModal" data-id="">Thêm sản phẩm</button>
                                <div class="text-danger fw-bold d-none" id="product-error">Bạn chưa chọn sản phẩm nào!</div>

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
                                    <button type='submit' class='btn btn-success fw-semibold text-dark'>Thêm mới</button>
                                    <button type="button" class="btn btn-secondary fw-semibold" data-bs-dismiss="modal">Đóng</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal phụ để thêm nhiều sản phẩm -->
            <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="addProductModalLabel">Thêm sản phẩm</h1>
                        </div>
                        <div class="modal-body">
                            <div id="product-select-wrapper">
                                <!-- Chọn sản phẩm và số lượng -->
                                <div class='form-group mb-3 product-item'>
                                    <label for='product'>Sản phẩm</label>
                                    <select class="form-control product-select">
                                        @foreach($product_theokhos as $product_theokho)
                                            <option value="{{ $product_theokho->id }}" data-price="{{ $product_theokho->Product->price_1_day }}" data-available-quantity="{{ $product_theokho->available_quantity }}">
                                                {{ $product_theokho->Product->product_name }} - {{ $product_theokho->title }} (Còn lại: {{ $product_theokho->available_quantity }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="number" placeholder="Số lượng" class="form-control quantity-input mt-2" />
                                    <span class="text-danger d-none error-message">Số lượng nhập vào vượt quá số lượng còn lại!</span>
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary mt-2" id="add-more-product">Thêm sản phẩm khác</button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="addProductsToList">Thêm vào hóa đơn</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>ID </th>
                        <th>Khách hàng</th>
                        <th>Sản phẩm</th>
                        <th>Số ngày thuê</th>
                        <th>Thành tiền</th>
                        <th>Khách cọc</th>
                        <th>Nhân viên</th>
                        <th>Thời gian</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($chothues as $chothue)
                        <tr data-id="{{$chothue->id}}">
                            <td> {{ $loop->iteration }}</td>
                            <td>{{$chothue->id}}</td>
                            <td>{{$chothue->Customer->name}} - {{$chothue->Customer->phone_number}}</td>
                            <td>{{$chothue->Product->product_name??"Chưa có sản phẩm"}}</td>
                            <td>{{$chothue->so_ngay_thue}}</td>
                            <td>{{$chothue->thanh_tien}}</td>
                            <td>{{$chothue->khach_coc}}</td>
                            <td>{{$chothue->Nhanvien->name}}</td>
                            <td>{{$chothue->updated_at}}</td>
                            <td class="">
                                    <button type="button" data-url="/chothues/{{$chothue->id}}" data-id="{{$chothue->id}}" class="btn btn-danger btnDeleteAsk px-2 me-2 py-1 fw-bolder" data-bs-toggle="modal" data-bs-target="#deleteModal{{$chothue->id}}">Xóa</button>
                                    <button type="button" data-id="{{$chothue->id}}" class="btn btn-edit btnEditChothue btn-info text-dark px-2 py-1 fw-bolder">Sửa</button>
                            </td>

                            <!-- Modal Delete -->
                            <div class="modal fade" id="deleteModal{{$chothue->id}}" tabindex="-1" aria-labelledby="deleteModal{{$chothue->id}}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 text-wrap" id="deleteModal{{$chothue->id}}Label">Bạn có chắc chắn xóa hóa đơn <b><u>{{$chothue->id}}</u></b>  không ?</h1>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="delete-forever btn btn-danger" data-id="{{ $chothue->id }}">Xóa</button>
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
                <div class="modal fade ModelEditChothue" id="editChothue" tabindex="-1" aria-labelledby="editChothueLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-danger" id="editChothueLabel">Chỉnh sửa hóa đơn</h1>
                            </div>
                            <div class="card-body">
                                <form method='post' action='' enctype="multipart/form-data" class="editChothueForm form-edit" id="form_chothueAdmin_update">
                                    @method('PATCH')
                                    @csrf
                                    <div class='mb-3'>
                                        <label class='form-label' for='edit-name_customer'>Tên khách hàng</label>
                                        <input type='text' class='form-control input-field' id='edit-name_customer' placeholder='Nhập tên khách hàng' name='name_customer' />
                                    </div>
                                    <div class='mb-3'>
                                        <label class='form-label' for='edit-phone_number'>Số điện thoại</label>
                                        <input type='text' class='form-control input-field' id='edit-phone_number' placeholder='Nhập số điện thoại' name='phone_number' />
                                    </div>
                                    
                                    <div class='mb-3'>
                                        <label class='form-label' for='basic-default-so_ngay_thue'>Số ngày thuê</label>
                                        <input type='number' class='form-control input-field' id='edit-so_ngay_thue' placeholder='Nhập số ngày thuê' name='so_ngay_thue' data-require='Mời nhập số ngày thuê' value="{{ old('so_ngay_thue') }}" />
                                        <button type="button" class="btn btn-warning mt-2" id="editUpdateTotalAmount">Cập nhật lại tiền</button> <!-- Nút cập nhật tiền -->
                                    </div>
                                    <!-- Nơi hiển thị danh sách sản phẩm -->
                                    <div id="edit-product-wrapper">
                                        <!-- Sản phẩm sẽ được thêm vào đây thông qua JavaScript -->
                                    </div>
                                    <button type="button" class="btn btn-primary btnEditProductModal mb-3" id="" data-id="">Thêm sản phẩm</button>
                                    <div class="text-danger fw-bold d-none edit-product-error" id="">Bạn chưa chọn sản phẩm nào!</div>

                                    <div class='mb-3'>
                                        <label class='form-label' for='edit-thanh_tien'>Thành tiền</label>
                                        <input type='number' step="0.01" class='form-control d-none' id='edit-thanh_tien' placeholder='Thành tiền' name='thanh_tien' readonly />
                                        <h3 class="fw-bold text-info" id="edit-thanh_tien_text"></h3>
                                    </div>
                                    <div class='mb-3'>
                                        <label class='form-label' for='edit-khach_coc'>Khách cọc</label>
                                        <input type='number' step="0.01" class='form-control input-field' id='edit-khach_coc' placeholder='Nhập số tiền khách cọc' name='khach_coc' />
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

                <!-- Modal phụ để chỉnh sửa sản phẩm trong phần Edit -->
                <div class="modal editProductModal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="editProductModalLabel">Chỉnh sửa sản phẩm</h1>
                            </div>
                            <div class="modal-body">
                                <div id="edit-product-select-wrapper">
                                    <!-- Chọn sản phẩm và số lượng -->
                                    <div class='form-group mb-3 edit-product-item'>
                                        <label for='product'>Sản phẩm</label>
                                        <select class="form-control product-select" id="edit-product-select">
                                            @foreach($product_theokhos as $product_theokho)
                                            <option value="{{ $product_theokho->id }}" data-price="{{ $product_theokho->Product->price_1_day }}" data-available-quantity="{{ $product_theokho->available_quantity }}">
                                                {{ $product_theokho->Product->product_name }} - {{ $product_theokho->title }} (Còn lại: {{ $product_theokho->available_quantity }})
                                            </option>                                            @endforeach
                                        </select>
                                        <input type="number" placeholder="Số lượng" id="edit-quantity-input" class="form-control quantity-input mt-2" />
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary add-more-product mt-2" id="">Thêm sản phẩm khác</button>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="saveEditedProduct">Lưu thay đổi</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pagination mt-4 pb-4">
                    {{ $chothues->links() }}
                </div>
               
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // if ($('#createchothue .alert-error').length > 0) {
            //     // Nếu có, hiển thị modal
            //     $('#createchothue').modal('show');
            // }

            // Thêm Tạo mới Hóa đơn
            $('#form_chothue_store').on('submit', function(e) {
                // Kiểm tra xem đã có sản phẩm nào trong #product-wrapper chưa
                if ($('#product-wrapper').children().length === 0) {
                    // Hiển thị lỗi nếu chưa có sản phẩm
                    $('#product-error').removeClass('d-none');
                    // Ngăn không cho submit form
                    e.preventDefault();
                } else {
                    // Ẩn thông báo lỗi nếu có sản phẩm
                    $('#product-error').addClass('d-none');
                }
            });

            let productIndex = 0;
            let totalAmount = 0; // Biến để lưu tổng thành tiền

            // Mở modal phụ khi bấm nút "Thêm sản phẩm"
            $('#openAddProductModal').on('click', function() {
                $('#addProductModal').modal('show');
            });

            // Sự kiện khi nhấn nút "Thêm vào hóa đơn"
            $('#addProductsToList').on('click', function(e) {
                let isValid = true; // Biến kiểm tra tính hợp lệ toàn bộ
                    let errorMessageShown = false; // Biến để đảm bảo chỉ hiển thị cảnh báo một lần

                    // Lặp qua tất cả các sản phẩm trong modal
                    $('.product-item').each(function() {
                        const quantityInput = $(this).find('.quantity-input'); // Lấy thẻ input số lượng
                        const quantity = parseInt(quantityInput.val()); // Số lượng nhập vào
                        const availableQuantity = parseInt($(this).find('.product-select option:selected').data('available-quantity')); // Số lượng còn lại
                        const errorMessage = $(this).find('.error-message'); // Lấy thẻ thông báo lỗi tương ứng với sản phẩm

                        // Kiểm tra nếu số lượng nhập vào lớn hơn số lượng còn lại
                        if (quantity > availableQuantity || isNaN(quantity)) {
                            errorMessage.removeClass('d-none'); // Hiển thị thông báo lỗi dưới input
                            isValid = false; // Đánh dấu không hợp lệ
                            errorMessageShown = true; // Đảm bảo thông báo lỗi đã hiển thị
                        } else {
                            errorMessage.addClass('d-none'); // Ẩn thông báo lỗi nếu hợp lệ
                        }
                    });

                    // Nếu có ít nhất một sản phẩm không hợp lệ, ngăn chặn việc tiếp tục
                    if (!isValid) {
                        e.preventDefault(); // Ngăn chặn form submit
                        if (!errorMessageShown) {
                            alert('Vui lòng kiểm tra lại số lượng các sản phẩm trước khi thêm vào hóa đơn.'); // Hiển thị thông báo lỗi chung
                        }
                        return;
                    }else{
                        $('#product-error').addClass('d-none');
                            // Lấy số ngày thuê từ modal chính
                            const soNgayThue = $('#so_ngay_thue').val();

                            if (soNgayThue == '' || soNgayThue <= 0) {
                                alert("Vui lòng nhập số ngày thuê hợp lệ.");
                                return;
                            }

                            // Lặp qua từng sản phẩm trong modal phụ
                            $('.product-item').each(function() {
                                const productId = $(this).find('.product-select').val();
                                const productText = $(this).find('.product-select option:selected').text();
                                const pricePerDay = $(this).find('.product-select option:selected').data('price');
                                const quantity = $(this).find('.quantity-input').val();

                                if (productId && quantity > 0) {
                                    const productWrapper = $('#product-wrapper');

                                    // Kiểm tra nếu sản phẩm đã tồn tại dựa trên value của input hidden
                                    const existingProduct = productWrapper.find(`input[name^="products"][name$="[id_product_theokho]"][value="${productId}"]`);

                                    if (existingProduct.length < 1) {
                                        // Nếu sản phẩm chưa tồn tại, thêm sản phẩm mới vào danh sách
                                        const thanhTien = quantity * pricePerDay * soNgayThue; 
                                        totalAmount += thanhTien; 

                                        const newProduct = `
                                            <div class='form-group mb-3 text-danger fw-bold product-item position-relative' data-price=${pricePerDay} data-product-index="${productIndex}">
                                                <label for='product'>Sản phẩm: ${productText}</label>
                                                <input type="hidden" name="products[${productIndex}][id_product_theokho]" value="${productId}">
                                                <input type="hidden" name="products[${productIndex}][quantity]" value="${quantity}">
                                                <input type="hidden" name="products[${productIndex}][thanh_tien]" value="${thanhTien}">
                                                
                                                <p>Số lượng: ${quantity} | Thành tiền: ${thanhTien.toLocaleString()} VND</p>
                                                <button type="button" class="btn btn-danger badge position-absolute top-0 end-0 remove-product" data-product-index="${productIndex}">Xóa</button>

                                            </div>
                                        `;
                                        productWrapper.append(newProduct);
                                        productIndex++;
                                    }
                                }
                            });

                            // Xử lý xóa sản phẩm
                            $('.remove-product').on('click', function() {
                                // Lấy thông tin của sản phẩm cần xóa
                                const productIndex = $(this).data('product-index');
                                const productItem = $(`.product-item[data-product-index="${productIndex}"]`);
                                const thanhTien = parseFloat(productItem.find('input[name$="[thanh_tien]"]').val());

                                // Trừ thành tiền của sản phẩm này khỏi tổng thành tiền
                                totalAmount -= thanhTien;

                                // Đảm bảo totalAmount không âm và đặt về 0 nếu không còn sản phẩm
                                totalAmount = totalAmount > 0 ? totalAmount : 0;

                                // Cập nhật lại tổng thành tiền hiển thị
                                $('#thanh_tien').text(Number(totalAmount.toFixed(2)).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));
                                $('#thanh_tien_input').val(totalAmount.toFixed(2));

                                // Xóa sản phẩm khỏi giao diện
                                productItem.remove();

                                // Kiểm tra nếu không còn sản phẩm nào, đặt tổng tiền về 0
                                if ($('#product-wrapper').children().length === 0) {
                                    totalAmount = 0;
                                    $('#thanh_tien').text('0 VND');
                                    $('#thanh_tien_input').val(0);
                                }
                            });

                            // Cập nhật tổng thành tiền
                            totalAmount = totalAmount > 0 ? totalAmount : 0;
                            $('#thanh_tien').text(Number(totalAmount.toFixed(2)).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));
                            $('#thanh_tien_input').val(totalAmount.toFixed(2));

                            // Đóng modal sản phẩm
                            $('#addProductModal').modal('hide');
                    }
                });

            // Thêm phần chọn sản phẩm mới khi bấm "Thêm sản phẩm khác"
            $('#add-more-product').on('click', function() {
                const newProductSelect = `
                    <div class='form-group mb-3 product-item'>
                        <label for='product'>Sản phẩm</label>
                        <select class="form-control product-select">
                            @foreach($product_theokhos as $product_theokho)
                                <option value="{{ $product_theokho->id }}" data-price="{{ $product_theokho->Product->price_1_day }}" data-available-quantity="{{ $product_theokho->available_quantity }}">
                                    {{ $product_theokho->Product->product_name }} - {{ $product_theokho->title }} (Còn lại: {{ $product_theokho->available_quantity }})
                                </option>
                            @endforeach
                        </select>
                        <input type="number" placeholder="Số lượng" class="form-control quantity-input mt-2" />
                        <span class="text-danger d-none error-message">Số lượng nhập vào vượt quá số lượng còn lại!</span> <br>
                        <button type="button" class="btn btn-danger mt-2 remove-product-btn">Xóa</button>
                    </div>
                `;
                $('#product-select-wrapper').append(newProductSelect);

                // Gắn sự kiện xóa cho nút "Xóa" của sản phẩm mới thêm
                $('.remove-product-btn').off('click').on('click', function() {
                    $(this).closest('.product-item').remove(); // Xóa phần product-item chứa nút "Xóa" được bấm
                });
            });

            // Sự kiện khi nhấn vào nút "Cập nhật lại tiền"
            $('#updateTotalAmount').on('click', function() {
                const soNgayThue = parseFloat($('#so_ngay_thue').val()); // Lấy số ngày thuê từ input và chuyển sang số
                totalAmount = 0; // Reset tổng tiền

                // Kiểm tra nếu số ngày thuê không hợp lệ hoặc nhỏ hơn hoặc bằng 0
                if (isNaN(soNgayThue) || soNgayThue <= 0) {
                    alert("Vui lòng nhập số ngày thuê hợp lệ.");
                    return;
                }

                // Lặp qua các sản phẩm đã thêm và tính lại tổng tiền
                $('#product-wrapper .product-item').each(function() {
                    const productPricePerDay = parseFloat($(this).data('price')); // Giá thuê sản phẩm theo ngày
                    const productQuantity = parseFloat($(this).find('input[name$="[quantity]"]').val()); // Số lượng sản phẩm

                    // Kiểm tra nếu giá sản phẩm hoặc số lượng không hợp lệ
                    if (isNaN(productPricePerDay) || isNaN(productQuantity) || productQuantity <= 0) {
                        alert("Có lỗi xảy ra với sản phẩm. Vui lòng kiểm tra lại giá và số lượng sản phẩm.");
                        return false; // Dừng lại nếu gặp lỗi
                    }

                    const thanhTien = productPricePerDay * productQuantity * soNgayThue; // Tính lại tiền theo số ngày thuê
                    totalAmount += thanhTien;

                    // Cập nhật lại thành tiền cho sản phẩm
                    $(this).find('input[name$="[thanh_tien]"]').val(thanhTien);
                    $(this).find('p').text(`Số lượng: ${productQuantity} | Thành tiền: ${thanhTien.toLocaleString()} VND`);
                });

                // Cập nhật lại tổng thành tiền hiển thị
                $('#thanh_tien').text(totalAmount.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));
                $('#thanh_tien_input').val(totalAmount.toFixed(2));
            });

            

            // Sửa hóa đơn
            var indexVal = 0;
            let editTotalAmount = 0; // Biến để lưu tổng thành tiền

            // Khi nhấn vào nút chỉnh sửa hóa đơn
            $('.btnEditChothue').on('click', function() {
                var chothueID = $(this).data('id'); // Lấy ID từ nút Sửa
                const ModelEdit = $('.ModelEditChothue');
                const editChothue = ModelEdit.attr('id', 'editChothue'+chothueID);
                const IdEditChothue = editChothue.attr('id');
                $('.editProductModal ').attr('data-id', chothueID);
                $('#saveEditedProduct').attr('data-id', chothueID);

                $.ajax({
                    url: '/chothues/' + chothueID, // URL API để lấy thông tin hóa đơn
                    type: 'GET',
                    success: function(response) {
                        // Cập nhật các trường dữ liệu trong modal Edit
                        $('#'+IdEditChothue + ' #edit-name_customer').val(response.customer.name);
                        $('#'+IdEditChothue + ' #edit-phone_number').val(response.customer.phone_number);
                        $('#'+IdEditChothue + ' #edit-so_ngay_thue').val(response.so_ngay_thue);
                        $('#'+IdEditChothue + ' #edit-thanh_tien').val(response.thanh_tien);
                        const thanhTienInput = parseFloat(response.thanh_tien);
                        if (!isNaN(thanhTienInput)) {
                            $('#'+IdEditChothue + ' #edit-thanh_tien_text').text(thanhTienInput.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));
                        }
                        $('#'+IdEditChothue + ' #edit-khach_coc').val(response.khach_coc);
                        $('#form_chothueAdmin_update').attr('action', '/chothues/' + chothueID)

                        // Xóa các sản phẩm cũ trước khi thêm mới
                        $('#'+IdEditChothue + ' #edit-product-wrapper').empty();

                        // Lặp qua danh sách sản phẩm và hiển thị chúng trong modal Edit
                        response.products.forEach(function(product, index) {
                            const productHtml = `
                                <div class='form-group mb-3 text-danger fw-bold edit-product-item position-relative' data-price="${product.price_1_day}" data-product-index="${index}">
                                    <label for='product'>Sản phẩm: ${product.product_name} - ${product.title_kho}</label>
                                    <input type="hidden" name="products[${index}][id_product_theokho]" value="${product.product_id}">
                                    <input type="hidden" name="products[${index}][quantity]" value="${product.quantity}">
                                    <input type="hidden" class="edit-thanh_tien_input" name="products[${index}][thanh_tien]" value="${product.thanh_tien}">
                                    <p>Số lượng: ${product.quantity} | Thành tiền: ${product.thanh_tien} VND</p>
                                    <button type="button" class="btn btn-danger badge position-absolute top-0 end-0 edit-remove-product" data-id=${product.chothue_product_id} data-product-index="${index}">Xóa</button>
                                </div>
                            `;
                            $('#'+IdEditChothue + ' #edit-product-wrapper').append(productHtml);
                            indexVal = index;
                        });

                        // Hiển thị modal Edit
                        $(editChothue).modal('show'); 

                        // Xử lý xóa sản phẩm
                        $('.edit-remove-product').on('click', function() {
                            const productIndex = $(this).data('product-index');
                            const productItem = $(`.edit-product-item[data-product-index="${productIndex}"]`);
                            const productId = $(this).data('id');
                            $.ajax({
                                url: '/chothue_product/delete/' + productId,
                                type: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  // Đảm bảo CSRF Token
                                },
                                success: function(response) {

                                    // Xóa sản phẩm khỏi giao diện
                                    productItem.remove();
                                },
                                error: function(xhr) {
                                    alert('Đã có lỗi xảy ra: ' + xhr.responseJSON.error);
                                }
                            });
                            let thanhTienInput = parseFloat(productItem.find('.edit-thanh_tien_input').val());

                            // Kiểm tra nếu thanhTienInput không hợp lệ (NaN), đặt về 0
                            if (isNaN(thanhTienInput)) {
                                thanhTienInput = 0;
                            }

                            // Trừ thành tiền của sản phẩm này khỏi tổng thành tiền
                            editTotalAmount = parseFloat($('#edit-thanh_tien').val()) || 0;
                            editTotalAmount -= thanhTienInput;

                            // Đảm bảo rằng totalAmount không bị âm hoặc NaN
                            editTotalAmount = editTotalAmount > 0 ? editTotalAmount : 0;

                            // Cập nhật lại tổng thành tiền hiển thị
                            $('#edit-thanh_tien_text').text(Number(editTotalAmount.toFixed(2)).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));
                            $('#edit-thanh_tien').val(editTotalAmount.toFixed(2));

                            // Xóa sản phẩm khỏi giao diện
                            productItem.remove();
                        });
                    },
                    error: function() {
                        alert('Không thể lấy dữ liệu chothue!');
                    }
                });
            });

            $('#form_chothueAdmin_update').on('submit', function(e) {
                // Kiểm tra xem đã có sản phẩm nào trong #product-wrapper chưa
                if ($('#edit-product-wrapper').children().length === 0) {
                    // Hiển thị lỗi nếu chưa có sản phẩm
                    $('#edit-product-error').removeClass('d-none');
                    // Ngăn không cho submit form
                    e.preventDefault();
                } else {
                    // Ẩn thông báo lỗi nếu có sản phẩm
                    $('#edit-product-error').addClass('d-none');
                }
            });

            // Mở modal phụ khi bấm nút "Thêm sản phẩm"
            $('.btnEditProductModal').on('click', function() {
                $('.editProductModal').modal('show');
            });

            // Thêm sản phẩm khác
            $('.add-more-product').on('click', function() {
                const newProductSelect = `
                    <div class='form-group mb-3 edit-product-item'>
                        <label for='product'>Sản phẩm</label>
                        <select class="form-control product-select">
                            @foreach($product_theokhos as $product_theokho)
                                <option value="{{ $product_theokho->id }}" data-price="{{ $product_theokho->Product->price_1_day }}" data-available-quantity="{{ $product_theokho->available_quantity }}">
                                    {{ $product_theokho->Product->product_name }} - {{ $product_theokho->title }} (Còn lại: {{ $product_theokho->available_quantity }})
                                </option>                            
                            @endforeach
                        </select>
                        <input type="number" placeholder="Số lượng" class="form-control quantity-input mt-2" />
                        <button type="button" class="btn btn-danger mt-2 remove-product-btn">Xóa</button>
                    </div>
                `;
                $('#edit-product-select-wrapper').append(newProductSelect);

                // Gắn sự kiện xóa cho nút "Xóa"
                $('.remove-product-btn').off('click').on('click', function() {
                    $(this).closest('.edit-product-item').remove(); 
                });
            });

            // Khi nhấn nút lưu chỉnh sửa sản phẩm
            $('#saveEditedProduct').on('click', function() {
                id = $(this).data('id');
                editChothue = 'editChothue' + id;
                $('.product-error').addClass('d-none');

                const soNgayThue = $('#' + editChothue + ' #edit-so_ngay_thue').val();

                if (soNgayThue == '' || soNgayThue <= 0) {
                    alert("Vui lòng nhập số ngày thuê.");
                    return;
                }

                let productIndex = 0;
                $('.edit-product-item').each(function() {
                    productIndex++;
                });
                let isValid = true;

                $('.edit-product-item').each(function() {
                    const quantityInput = $(this).find('.quantity-input'); // Lấy thẻ input số lượng
                    const quantity = parseInt(quantityInput.val()); // Số lượng nhập vào
                    const availableQuantity = parseInt($(this).find('.product-select option:selected').data('available-quantity')); // Số lượng còn lại
                    const errorMessage = $(this).find('.edit-error-message'); // Lấy thẻ thông báo lỗi tương ứng với sản phẩm

                    // Kiểm tra nếu số lượng nhập vào lớn hơn số lượng còn lại
                    if (quantity > availableQuantity || isNaN(quantity)) {
                        errorMessage.removeClass('d-none'); // Hiển thị thông báo lỗi dưới input
                        isValid = false; // Đánh dấu không hợp lệ
                    } else {
                        errorMessage.addClass('d-none'); // Ẩn thông báo lỗi nếu hợp lệ
                    }
                });

                // Nếu có lỗi, ngăn chặn việc tiếp tục
                if (!isValid) {
                    alert('Vui lòng kiểm tra lại số lượng các sản phẩm.');
                    return false;
                }else{
                    // Lặp qua từng sản phẩm trong modal phụ
                    $('.edit-product-item').each(function() {
                        const productId = $(this).find('.product-select').val();
                        const productText = $(this).find('.product-select option:selected').text();
                        const pricePerDay = $(this).find('.product-select option:selected').data('price');
                        const quantity = $(this).find('.quantity-input').val();

                        if (productId && quantity > 0) {
                            const productWrapper = $('#edit-product-wrapper');
                            const existingProduct = productWrapper.find(`input[name^="products"][name$="[id_product_theokho]"][value="${productId}"]`);

                            if (existingProduct.length < 1) {
                                const thanhTienInput = quantity * pricePerDay * soNgayThue;

                                const newProduct = `
                                    <div class='form-group mb-3 text-danger fw-bold edit-product-item position-relative' data-price=${pricePerDay} data-product-index="${productIndex}">
                                        <label for='product'>Sản phẩm: ${productText}</label>
                                        <input type="hidden" name="products[${productIndex}][id_product_theokho]" value="${productId}">
                                        <input type="hidden" name="products[${productIndex}][quantity]" value="${quantity}">
                                        <input type="hidden" class="edit-thanh_tien_input" name="products[${productIndex}][thanh_tien]" value="${thanhTienInput}">
                                        <p>Số lượng: ${quantity} | Thành tiền: ${thanhTienInput.toLocaleString()} VND</p>
                                        <button type="button" class="btn btn-danger badge position-absolute top-0 end-0 edit-remove-product" data-product-index="${productIndex}">Xóa</button>
                                    </div>
                                `;
                                productWrapper.append(newProduct);
                                productIndex++;
                            }
                        }
                    });

                    $('.editProductModal').modal('hide');
                    editTotalAmount = 0;

                    // Tính lại tổng tiền cho tất cả sản phẩm trong danh sách
                    $('#edit-product-wrapper .edit-product-item').each(function() {
                        let thanhTienInput = parseFloat($(this).find('.edit-thanh_tien_input').val());

                        // Kiểm tra nếu thanhTienInput không hợp lệ (NaN), đặt về 0
                        if (isNaN(thanhTienInput)) {
                            thanhTienInput = 0;
                        }

                        editTotalAmount += thanhTienInput;
                    });

                    // Cập nhật tổng tiền sau khi thêm mới
                    $('#edit-thanh_tien_text').text(Number(editTotalAmount.toFixed(2)).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));
                    $('#edit-thanh_tien').val(editTotalAmount.toFixed(2));

                    // Xử lý xóa sản phẩm sau khi thêm mới
                    $('.edit-remove-product').on('click', function() {
                        // Lấy thông tin của sản phẩm cần xóa
                        const productIndex = $(this).data('product-index');
                        const productItem = $(`.edit-product-item[data-product-index="${productIndex}"]`);
                        let thanhTienInput = parseFloat(productItem.find('.edit-thanh_tien_input').val());

                        // Kiểm tra nếu thanhTienInput không hợp lệ (NaN), đặt về 0
                        if (isNaN(thanhTienInput)) {
                            thanhTienInput = 0;
                        }

                        // Trừ thành tiền của sản phẩm này khỏi tổng thành tiền
                        editTotalAmount -= thanhTienInput;

                        // Đảm bảo rằng totalAmount không bị âm hoặc NaN
                        editTotalAmount = editTotalAmount > 0 ? editTotalAmount : 0;

                        // Cập nhật lại tổng thành tiền hiển thị
                        $('#edit-thanh_tien_text').text(Number(editTotalAmount.toFixed(2)).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));
                        $('#edit-thanh_tien').val(editTotalAmount.toFixed(2));

                        // Xóa sản phẩm khỏi giao diện
                        productItem.remove();
                    });

                    // Cập nhật tổng thành tiền
                    $('#edit-thanh_tien_text').text(Number(editTotalAmount.toFixed(2)).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));
                    $('#edit-thanh_tien').val(editTotalAmount.toFixed(2));
                }
            });

            // Sự kiện khi nhấn vào nút "Cập nhật lại tiền"
            $('#editUpdateTotalAmount').on('click', function() {
                const soNgayThue = parseFloat($('#edit-so_ngay_thue').val()); // Lấy số ngày thuê từ input và chuyển sang số
                editTotalAmount = 0; // Reset tổng tiền

                // Kiểm tra nếu số ngày thuê không hợp lệ hoặc nhỏ hơn hoặc bằng 0
                if (isNaN(soNgayThue) || soNgayThue <= 0) {
                    alert("Vui lòng nhập số ngày thuê hợp lệ.");
                    return;
                }

                // Lặp qua các sản phẩm đã thêm và tính lại tổng tiền
                $('#edit-product-wrapper .edit-product-item').each(function() {
                    const productPricePerDay = parseFloat($(this).data('price')); // Giá thuê sản phẩm theo ngày
                    const productQuantity = parseFloat($(this).find('input[name$="[quantity]"]').val()); // Số lượng sản phẩm

                    // Kiểm tra nếu giá sản phẩm hoặc số lượng không hợp lệ
                    if (isNaN(productPricePerDay) || isNaN(productQuantity) || productQuantity <= 0) {
                        alert("Có lỗi xảy ra với sản phẩm. Vui lòng kiểm tra lại giá và số lượng sản phẩm.");
                        return false; // Dừng lại nếu gặp lỗi
                    }

                    const thanhTienInput = productPricePerDay * productQuantity * soNgayThue; // Tính lại tiền theo số ngày thuê
                    editTotalAmount += thanhTienInput;

                    // Cập nhật lại thành tiền cho sản phẩm
                    $(this).find('input[name$="[thanh_tien]"]').val(thanhTienInput);
                    $(this).find('p').text(`Số lượng: ${productQuantity} | Thành tiền: ${thanhTienInput.toLocaleString()} VND`);
                });

                // Cập nhật lại tổng thành tiền hiển thị
                $('#edit-thanh_tien_text').text(editTotalAmount.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));
                $('#edit-thanh_tien').val(editTotalAmount.toFixed(2));
            });

        });
    </script>
@endsection

