
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
    });
    document.addEventListener("DOMContentLoaded", function() {
        // Lấy tất cả các ô có class "currency"
        const currencyElements = document.querySelectorAll(".currency");

        currencyElements.forEach(element => {
            // Lấy giá trị và chuyển sang định dạng tiền tệ VNĐ
            const value = parseFloat(element.innerText);
            if (!isNaN(value)) {
                element.innerText = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(value);
            }
        });
    });
</script>
<script>
    CKEDITOR.replace("ckeditor-desc");
    CKEDITOR.replace("ckeditor-content");
    CKEDITOR.replace("ckeditor-thongsokythuat");
</script>

<script src="/temp/js/admin.js"></script>
<script src="/temp/js/main.js"></script>
<script src="/temp/js/validate.js"></script>
<script src="/temp/js/owl.carousel.min.js"></script>
<script src="/temp/vendor/libs/jquery/jquery.js"></script>
<script src="/temp/vendor/libs/popper/popper.js"></script>
<script src="/temp/vendor/js/bootstrap.js"></script>
<script src="/temp/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

<script src="/temp/vendor/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="/temp/vendor/libs/apex-charts/apexcharts.js"></script>

<!-- Main JS -->
<script src="/temp/js/main.js"></script>

<!-- Page JS -->
<script src="/temp/js/dashboards-analytics.js"></script>
<script src="/ckeditor/ckeditor.js"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>



