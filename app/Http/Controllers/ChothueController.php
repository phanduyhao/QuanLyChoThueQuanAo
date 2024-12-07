<?php

namespace App\Http\Controllers;

use App\Models\Kho;
use App\Models\Chothue;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Customer;
use App\Models\Doanhthu;
use Illuminate\Http\Request;
use App\Models\Chothue_Product;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ChothueController extends Controller
{
    use ValidatesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = 20;
        $searchId = $request->input('search_id');
        $searchCustomer = $request->input('search_customer');
        $searchStatus = $request->input('search_status');
        $searchEmployee = $request->input('search_employee');
        $searchSize = $request->input('search_size'); 

        // Lọc các hóa đơn cho thuê dựa trên điều kiện tìm kiếm
        $chothues = Chothue::where('Xoa', null)->orderByDesc('id')
            ->when($searchId, function ($query, $searchId) {
                return $query->where('id', $searchId);
            })
            ->when($searchCustomer, function ($query, $searchCustomer) {
                return $query->whereHas('customer', function ($q) use ($searchCustomer) {
                    $q->where('name', 'like', '%' . $searchCustomer . '%')
                      ->orWhere('phone_number', 'like', '%' . $searchCustomer . '%');
                });
            })
            ->when($searchStatus !== null, function ($query) use ($searchStatus) {
                return $query->where('trangthai', $searchStatus);
            })
            ->when($searchEmployee, function ($query, $searchEmployee) {
                return $query->whereHas('nhanvien', function ($q) use ($searchEmployee) {
                    $q->where('name', 'like', '%' . $searchEmployee . '%');
                });
            })
            ->when($searchSize, function ($query, $searchSize) {
                return $query->whereHas('product', function ($q) use ($searchSize) {
                    $q->where('size', 'like', '%' . $searchSize . '%');
                });
            })
            ->paginate($perPage);
    
        // Lấy danh sách các kho và tính toán số lượng còn lại của sản phẩm trong từng kho
        $product_theokhos = Kho::where('Xoa', null)->orderBy('title')->get()->map(function ($kho) {
            $totalRented = Chothue::where('Xoa', null)->where('id_kho', $kho->id)->sum('quantity');
            $availableQuantity = $kho->quantity - $totalRented;
            $kho->available_quantity = max(0, $availableQuantity);
            return $kho;
        });
    

        $tencuahang = Setting::where('setting_code', 'ten_cua_hang')->value('value');
        $sdt = Setting::where('setting_code', 'sdt')->value('value');
        $stk = Setting::where('setting_code', 'stk')->value('value');
        $dia_chi = Setting::where('setting_code', 'dia_chi')->value('value');
        $link_qr = Setting::where('setting_code', 'link_qr_code')->value('value');
        $ghi_chu = Setting::where('setting_code', 'ghi_chu')->value('value');

        // Trả về view với dữ liệu đã tính toán
        return view('chothues.index', compact('chothues', 'product_theokhos','tencuahang','sdt','stk','link_qr','ghi_chu','dia_chi'), [
            'title' => 'Cho thuê'
        ]);
    }
    
    
    public function store(Request $request)
    {
        // Validate input trước
        $this->validate($request, [
            'name_customer' => 'required',
            'phone_number' => 'required',
            'so_ngay_thue' => 'required|integer|min:1',
            'id_kho' => 'required|exists:khos,id',
            'quantity' => 'required|integer|min:1', 
            'thanh_tien' => 'required|numeric|min:0', 
            'khach_coc' => 'required|numeric|min:0' 
        ], [
            'name_customer.required' => 'Vui lòng nhập tên khách hàng!',
            'phone_number.required' => 'Vui lòng nhập số điện thoại!',
            'so_ngay_thue.required' => 'Vui lòng nhập số ngày thuê!',
            'so_ngay_thue.integer' => 'Số ngày thuê phải là một số nguyên!',
            'id_kho.required' => 'Vui lòng chọn sản phẩm!',
            'id_kho.exists' => 'Sản phẩm không tồn tại!',
            'quantity.required' => 'Vui lòng nhập số lượng!',
            'quantity.integer' => 'Số lượng phải là một số nguyên!',
            'thanh_tien.required' => 'Vui lòng nhập tổng tiền!',
            'khach_coc.required' => 'Vui lòng nhập số tiền khách cọc!',
            'thanh_tien.numeric' => 'Thành tiền phải là một số!',
            'khach_coc.numeric' => 'Khách cọc phải là một số!',
        ]);
    
        // Kiểm tra xem khách hàng với số điện thoại đã tồn tại chưa
        $customer = Customer::where('phone_number', $request->phone_number)->first();
    
        if (!$customer) {
            $customer = new Customer;
            $customer->name = $request->name_customer;
            $customer->phone_number = $request->phone_number;
            $customer->save();
        }

        // Lấy sản phẩm từ kho và kiểm tra số lượng còn lại
        $kho = Kho::find($request->id_kho);

        // Tạo mới hóa đơn cho thuê
        $chothue = new Chothue;
        $chothue->id_customer = $customer->id;
        $chothue->id_kho = $request->id_kho;
        $chothue->quantity = $request->quantity;

        $chothue->so_ngay_thue = $request->so_ngay_thue; 
        $chothue->thanh_tien = $request->thanh_tien; 
        $chothue->trangthai = 1; 
        $chothue->khach_coc = $request->khach_coc; 
        $chothue->id_nhanvien = Auth::user()->id; 
        $chothue->soluongconlai = $request->soluongconlai-$request->quantity;
        $chothue->save();
        $kho = Kho::find($request->id_kho);
        $chothue->id_product = $kho->id_product;
        $chothue->save();
        
        $doanhthu = new Doanhthu;
        $doanhthu->id_chothue = $chothue->id;
        $doanhthu->id_kho = $request->id_kho;
        $doanhthu->doanh_thu_thuc_te = $request->khach_coc;
        $doanhthu->doanh_thu_du_kien = $request->thanh_tien;
        $doanhthu->save();

        $chothue->save();

        return redirect()->route('chothues.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Tìm thông tin hóa đơn
        $chothue = Chothue::find($id);
        
        // Kiểm tra nếu không tìm thấy hóa đơn
        if (!$chothue) {
            return response()->json([
                'message' => 'Không tìm thấy chothue với ID: ' . $id
            ], 404); 
        }
    
        // Lấy thông tin khách hàng
        $customer = $chothue->customer;
    
        // // Lấy danh sách sản phẩm từ bảng chothue_products theo id_chothue
        // $products = Chothue_Product::join('khos', 'chothue_products.id_product_theokho', '=', 'khos.id')
        // ->join('products', 'khos.id_product', '=', 'products.id') // Kết nối bảng kho với bảng products
        // ->where('chothue_products.id_chothue', $id)
        // ->select('products.id as product_id', 'products.product_name','khos.title as title_kho', 'chothue_products.id as chothue_product_id', 'products.price_1_day', 'chothue_products.quantity', 'chothue_products.thanh_tien')
        // ->get();
    
    
        // Trả về JSON bao gồm thông tin hóa đơn và danh sách sản phẩm
        return response()->json([
            'id' => $chothue->id,
            'customer' => [
                'name' => $customer->name,
                'phone_number' => $customer->phone_number
            ],
            // 'products' => $products, // Danh sách sản phẩm
            'so_ngay_thue' => $chothue->so_ngay_thue,
            'thanh_tien' => $chothue->thanh_tien,
            'khach_coc' => $chothue->khach_coc,
            'quantity' => $chothue->quantity,
            'id_kho' => $chothue->id_kho,
            'trangthai' => $chothue->trangthai, 
            'nhanvien' => $chothue->nhanvien->name,
            'updated_at' => $chothue->updated_at
        ]);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chothue $chothue)
    {
        // Validate input trước
        $this->validate($request, [
            'name_customer' => 'required',
            'phone_number' => 'required',
            'so_ngay_thue' => 'required|integer|min:1',
            'id_kho' => 'required|exists:khos,id',
            'quantity' => 'required|integer|min:1', 
            'thanh_tien' => 'required|numeric|min:0', 
            'khach_coc' => 'required|numeric|min:0' 
        ], [
            'name_customer.required' => 'Vui lòng nhập tên khách hàng!',
            'phone_number.required' => 'Vui lòng nhập số điện thoại!',
            'so_ngay_thue.required' => 'Vui lòng nhập số ngày thuê!',
            'so_ngay_thue.integer' => 'Số ngày thuê phải là một số nguyên!',
            'id_kho.required' => 'Vui lòng chọn sản phẩm!',
            'id_kho.exists' => 'Sản phẩm không tồn tại!',
            'quantity.required' => 'Vui lòng nhập số lượng!',
            'quantity.integer' => 'Số lượng phải là một số nguyên!',
            'thanh_tien.required' => 'Vui lòng nhập tổng tiền!',
            'khach_coc.required' => 'Vui lòng nhập số tiền khách cọc!',
            'thanh_tien.numeric' => 'Thành tiền phải là một số!',
            'khach_coc.numeric' => 'Khách cọc phải là một số!',
        ]);
    
        $customer = Customer::where('phone_number', $request->phone_number)->first();
    
        if (!$customer) {
            $customer = new Customer;
            $customer->name = $request->name_customer;
            $customer->phone_number = $request->phone_number;
            $customer->save();
        }
    
        // Lấy sản phẩm từ kho và kiểm tra số lượng còn lại
        $kho = Kho::find($request->id_kho);
        if (!$kho) {
            return redirect()->back()->with('error', 'Kho không tồn tại!');
        }
    
        // Tính toán số lượng đã được thuê trước đó và số lượng hiện tại
        $totalRented = Chothue::where('id_kho', $kho->id)->where('id', '!=', $chothue->id)->sum('quantity');
        $availableQuantity = $kho->quantity - $totalRented;
    
        // Kiểm tra nếu số lượng yêu cầu lớn hơn số lượng còn lại
        if ($request->quantity > $availableQuantity) {
            return redirect()->back()->with('error', 'Số lượng sản phẩm trong kho không đủ để cho thuê.');
        }
    
        // Cập nhật thông tin hóa đơn cho thuê
        $chothue->id_customer = $customer->id;;
        $chothue->id_kho = $request->id_kho;
        $chothue->quantity = $request->quantity;
        $chothue->soluongconlai = $request->soluongconlai-$request->quantity;
        $chothue->so_ngay_thue = $request->so_ngay_thue; 
        $chothue->thanh_tien = $request->thanh_tien; 
        $chothue->khach_coc = $request->khach_coc;
        // $chothue->id_nhanvien = Auth::user()->id;
        $chothue->trangthai = $request->trangthai;
        $chothue->save();
    
        // Cập nhật thông tin doanh thu
        $doanhthu = Doanhthu::where('id_chothue', $chothue->id)
            ->first();
        $doanhthu->id_kho = $request->id_kho;
        if($chothue->trangthai == 0){
            $doanhthu->doanh_thu_thuc_te = $doanhthu->doanh_thu_du_kien;
        }else{
            $doanhthu->doanh_thu_thuc_te = $request->khach_coc;
        }
        $doanhthu->doanh_thu_du_kien = $request->thanh_tien;
        $doanhthu->save();
    
        // Sau khi cập nhật thành công, cập nhật lại số lượng còn lại trong kho
        $newAvailableQuantity = $availableQuantity - $request->quantity;
        $chothue->soluongconlai = max(0, $newAvailableQuantity); // Đảm bảo không bị âm
        $chothue->save();
    
        return redirect()->back()->with('success', 'Cập nhật thành công!');
    }
    
    public function autocompleteCustomers(Request $request)
    {
        $search = $request->get('term');
    
        // Tìm khách hàng theo tên
        $customers = Customer::where('name', 'LIKE', '%' . $search . '%')
            ->limit(10)
            ->get();
    
        $result = [];
        foreach ($customers as $customer) {
            $result[] = [
                'id' => $customer->id,
                'value' => $customer->name, // Hiển thị tên khách hàng trong danh sách
                'phone_number' => $customer->phone_number // Trả về số điện thoại
            ];
        }
        return response()->json($result);
    }



    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $chothue = Chothue::find($id);

        if (!$chothue) {
            return response()->json([
               'message' => 'Không tìm thấy khách hàng với ID: '. $id
            ], 404); 
        }

        $chothue->Xoa = true;
        $chothue->save();

        return response()->json([
           'message' => 'Đã xóa khách hàng ID: '. $id
        ], 200);
    }
}
