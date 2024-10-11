@extends('main')
@section('contents')

    <div class="container-fluid flex-grow-1 container-p-y">
        <h3 class="fw-bold text-primary py-3 mb-4">{{$title}}</h3>
        <div>
            <form class="form-search" method="GET" action="{{ route('chothues.index') }}">
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
                            <input class="form-control shadow-none" type="text" name="search_customer" placeholder="Tìm theo tên khách hàng ( sđt )..." value="{{ request('search_customer') }}">
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12 mb-3">
                            <input class="form-control shadow-none" type="text" name="search_employee" placeholder="Tìm theo nhân viên.." value="{{ request('search_employee') }}">
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12 mb-3">
                            <select name="search_status" class="form-control">
                                <option value="">Chọn trạng thái</option>
                                <option value="1" {{ request('search_status') == '1' ? 'selected' : '' }}>Đang cho thuê</option>
                                <option value="0" {{ request('search_status') == '0' ? 'selected' : '' }}>Đã trả</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12 mb-3">
                            <div class="text-nowrap">
                                <button type="submit" class="btn btn-danger rounded-pill"><i class="fas fa-search me-2"></i>Tìm kiếm</button>
                                <a href="{{ route('chothues.index') }}" class="btn btn-secondary rounded-pill ms-2"><i class="fas fa-times me-2"></i>Xóa lọc</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
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


            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>ID </th>
                        <th>Khách hàng</th>
                        <th>Sẳn phẩm</th>
                        <th>Số ngày thuê</th>
                        <th>Thành tiền</th>
                        <th>Khách cọc</th>
                        <th>Trạng thái</th>
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
                            <td>{{$chothue->Product->product_name}} - {{$chothue->Product->size}}</td>
                            <td>{{$chothue->so_ngay_thue}}</td>
                            <td>{{$chothue->thanh_tien}}</td>
                            <td>{{$chothue->khach_coc}}</td>
                            <td>
                                @if($chothue->trangthai == 1)
                                    <span class="text-warning fw-bold">Đang cho thuê</span>
                                @else
                                    <span class="text-success fw-bold">Đã trả</span>
                                @endif
                            </td>
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
                                        {{-- <button type="button" class="btn btn-warning mt-2" id="editUpdateTotalAmount">Cập nhật lại tiền</button> <!-- Nút cập nhật tiền --> --}}
                                    </div>
                                    <div class='form-group mb-3 product-item'>
                                        <label for='product'>Sản phẩm</label>
                                        <select class="form-control product-select" name="id_kho" id='edit-id_product_theokho'>
                                            @foreach($product_theokhos as $product_theokho)
                                                <option value="{{ $product_theokho->id }}" data-price="{{ $product_theokho->Product->price_1_day }}" data-available-quantity="{{ $product_theokho->available_quantity }}">
                                                    {{ $product_theokho->Product->product_name }} - {{ $product_theokho->title }} (Còn lại: {{ $product_theokho->available_quantity }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="number" name="soluongconlai" id="edit-soluongconlai" value="" hidden>
                                        <input type="number" name="quantity" id="edit-quantity" placeholder="Số lượng" class="form-control quantity-input mt-2 input-field" data-require='Mời nhập số lượng' />
                                        <span class="text-danger d-none error-message">Số lượng nhập vào vượt quá số lượng còn lại!</span>
                                    </div>
                                    <div class='mb-3'>
                                        <label class='form-label' for='edit-thanh_tien'>Thành tiền</label>
                                        <input type='number' step="0.01" class='form-control d-none' id='edit-thanh_tien' placeholder='Thành tiền' name='thanh_tien' readonly />
                                        <h3 class="fw-bold text-info" id="edit-thanh_tien_text"></h3>
                                    </div>
                                    <div class='mb-3'>
                                        <label class='form-label' for='edit-khach_coc'>Khách cọc</label>
                                        <input type='number' step="0.01" class='form-control input-field' id='edit-khach_coc' placeholder='Nhập số tiền khách cọc' name='khach_coc' />
                                    </div>
                                    <div class='mb-3'>
                                        <label class='form-label' for='edit-status'>Trạng thái</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="trangthai" id="trangthai1" value="0">
                                            <label class="form-check-label" for="trangthai1">
                                                Đã trả
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="trangthai" id="trangthai2" value="1">
                                            <label class="form-check-label" for="trangthai3">
                                                Đang cho thuê
                                            </label>
                                        </div>
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

            let productIndex = 0;
            let totalAmount = 0; // Biến để lưu tổng thành tiền
             // Hàm định dạng số thành tiền tệ
            function formatCurrency(value) {
                return value.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }).replace('₫', '').trim() + ' VNĐ';
            }

            // Hàm tính toán thành tiền
            function calculateTotal() {
                const soNgayThue = parseFloat($('#so_ngay_thue').val()) || 0;
                const quantity = parseFloat($('.quantity-input').val()) || 0;
                const selectedOption = $('.product-select option:selected');
                const pricePerDay = parseFloat(selectedOption.data('price')) || 0;
                const availableQuantity = parseInt(selectedOption.data('available-quantity')) || 0; // Số lượng còn lại

                // Kiểm tra số lượng
                if (quantity > availableQuantity) {
                    $('.error-message').removeClass('d-none').text(`Số lượng nhập vào vượt quá số lượng còn lại: ${availableQuantity}`);
                    $('#form_chothue_store').find('button[type="submit"]').prop('disabled', true); // Vô hiệu hóa nút submit
                } else {
                    $('.error-message').addClass('d-none'); // Xóa thông báo lỗi
                    $('#form_chothue_store').find('button[type="submit"]').prop('disabled', false); // Kích hoạt nút submit
                }

                // Tính toán thành tiền
                const totalAmount = soNgayThue * pricePerDay * quantity;
                const formattedAmount = formatCurrency(totalAmount); // Định dạng thành tiền
                $('#thanh_tien').text(formattedAmount);
                $('#thanh_tien_input').val(totalAmount.toFixed(2));
            }

            // Gắn sự kiện thay đổi cho số ngày thuê
            $('#so_ngay_thue').on('input', function() {
                calculateTotal();
            });

            // Gắn sự kiện thay đổi cho số lượng
            $('.quantity-input').on('input', function() {
                calculateTotal();
            });

            // Gắn sự kiện thay đổi cho sản phẩm
            $('.product-select').on('change', function() {
                calculateTotal();
            });
            $('#createchothue').on('show.bs.modal', function (e) {
                const selectedOption = $('#id_product_theokho').find(':selected');
                const availableQuantity = selectedOption.data('available-quantity');
                $('#soluongconlai').val(availableQuantity);
            });

            // Khi thay đổi sản phẩm, cập nhật lại số lượng còn lại
            $('#edit-id_product_theokho').on('change', function() {
                const selectedOption = $(this).find(':selected');
                const availableQuantity = selectedOption.data('available-quantity');
                $('#soluongconlai').val(availableQuantity);
            });




            // Sửa hóa đơn
           // Hàm định dạng số thành tiền tệ
            function formatCurrency(value) {
                return value.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }).replace('₫', '').trim() + ' VNĐ';
            }

            function getOldQuantity(){
                return parseFloat($('#edit-quantity').data('old-quantity')) || 0; 

            }

            // Hàm tính toán thành tiền trong modal Edit
            function calculateEditTotal(old_quantity) {
                const soNgayThue = parseFloat($('#edit-so_ngay_thue').val()) || 0;
                const newQuantity = parseFloat($('#edit-quantity').val()) || 0; // Số lượng mới
                const oldQuantity = getOldQuantity(); // Số lượng cũ (đã thuê trước đó)
                const selectedOption = $('#edit-id_product_theokho option:selected');
                const pricePerDay = parseFloat(selectedOption.data('price')) || 0;
                const availableQuantity = parseInt(selectedOption.data('available-quantity')) || 0; // Số lượng khả dụng hiện tại (không tính số lượng cũ)
                console.log('old-quantity: ', oldQuantity);
                console.log('new-quantity: ', newQuantity);
                const havingQuantity = availableQuantity + oldQuantity;
                // Tính số lượng thực sự còn lại trong kho sau khi trừ đi số lượng cũ
                const totalAvailableQuantity = newQuantity - oldQuantity;;
                console.log('totalAvailableQuantity: ', totalAvailableQuantity);

                // Kiểm tra nếu số lượng mới lớn hơn số lượng khả dụng hiện tại + số lượng cũ
                if (totalAvailableQuantity > availableQuantity) {
                    $('.error-message').removeClass('d-none').text(`Số lượng nhập vượt quá số lượng còn lại: ${havingQuantity} ( đã cộng số lượng cũ vừa xóa)`);
                    $('#form_chothueAdmin_update').find('button[type="submit"]').prop('disabled', true); // Vô hiệu hóa nút submit
                } else {
                    $('.error-message').addClass('d-none'); // Xóa thông báo lỗi nếu hợp lệ
                    $('#form_chothueAdmin_update').find('button[type="submit"]').prop('disabled', false); // Kích hoạt nút submit
                }

                // Tính toán thành tiền dựa trên số ngày thuê, giá mỗi ngày và số lượng mới
                const totalAmount = soNgayThue * pricePerDay * newQuantity;
                const formattedAmount = formatCurrency(totalAmount); // Định dạng thành tiền
                $('#edit-thanh_tien_text').text(formattedAmount);
                $('#edit-thanh_tien').val(totalAmount.toFixed(2));
            }

            // Sự kiện khi nhập số ngày thuê
            $('#edit-so_ngay_thue').on('input', function() {
                calculateEditTotal();
            });
            $('#edit-quantity').on('click', function() {
                getOldQuantity();
                console.log(getOldQuantity());
            })
            // Sự kiện khi nhập số lượng
            $('#edit-quantity').on('input', function() {
                calculateEditTotal();
            });

            // Sự kiện khi chọn sản phẩm
            $('#edit-id_product_theokho').on('change', function() {
                calculateEditTotal();
            });

            // Khi nhấn vào nút chỉnh sửa hóa đơn
            $('.btnEditChothue').on('click', function() {
                var chothueID = $(this).data('id'); // Lấy ID từ nút Sửa
                const ModelEdit = $('.ModelEditChothue');
                const editChothue = ModelEdit.attr('id', 'editChothue' + chothueID);
                const IdEditChothue = editChothue.attr('id');
                $('.editProductModal ').attr('data-id', chothueID);
                $('#saveEditedProduct').attr('data-id', chothueID);

                $.ajax({
                    url: '/chothues/' + chothueID, // URL API để lấy thông tin hóa đơn
                    type: 'GET',
                    success: function(response) {
                        // Cập nhật các trường dữ liệu trong modal Edit
                        $('#' + IdEditChothue + ' #edit-name_customer').val(response.customer.name);
                        $('#' + IdEditChothue + ' #edit-phone_number').val(response.customer.phone_number);
                        $('#' + IdEditChothue + ' #edit-so_ngay_thue').val(response.so_ngay_thue);
                        $('#' + IdEditChothue + ' #edit-thanh_tien').val(response.thanh_tien);
                        $('#' + IdEditChothue + ' #edit-id_product_theokho').val(response.id_kho);
                        $('#' + IdEditChothue + ' #edit-quantity').val(response.quantity);
                        $('#' + IdEditChothue + ' #edit-quantity').attr("data-old-quantity",response.quantity);
                        $('#' + IdEditChothue + ' #edit-thanh_tien_text').text(formatCurrency(response.thanh_tien)); // Hiển thị thành tiền từ dữ liệu

                        if (response.trangthai == 1) {
                            $('#' + IdEditChothue + ' #trangthai2').prop('checked', true); // Đánh dấu radio "Đang cho thuê"
                        } else {
                            $('#' + IdEditChothue + ' #trangthai1').prop('checked', true); // Đánh dấu radio "Đã trả"
                        }

                        $('#' + IdEditChothue + ' #edit-khach_coc').val(response.khach_coc);
                        $('#form_chothueAdmin_update').attr('action', '/chothues/' + chothueID);

                        // Hiển thị modal Edit
                        $(editChothue).modal('show');
                        
                        // Không gọi calculateEditTotal() ngay lập tức
                    },
                    error: function() {
                        alert('Không thể lấy dữ liệu chothue!');
                    }
                });
                $('#editChothue').on('show.bs.modal', function (e) {
                    const selectedOption = $('#edit-id_product_theokho').find(':selected');
                    const availableQuantity = selectedOption.data('available-quantity');
                    const oldQuantity = $('#edit-quantity').val();
                    availableQuantity += oldQuantity;
                    $('#edit-soluongconlai').val(availableQuantity);
                });

                // Khi thay đổi sản phẩm, cập nhật lại số lượng còn lại
                $('#id_product_theokho').on('change', function() {
                    const selectedOption = $(this).find(':selected');
                    const availableQuantity = selectedOption.data('available-quantity');
                    const oldQuantity = $('#edit-quantity').val();
                    availableQuantity += oldQuantity;
                    $('#edit-soluongconlai').val(availableQuantity);
                });
            });
        });

    </script>
@endsection

