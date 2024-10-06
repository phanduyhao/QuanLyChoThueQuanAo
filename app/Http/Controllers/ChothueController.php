<?php

namespace App\Http\Controllers;

use App\Models\Kho;
use App\Models\Chothue;
use App\Models\Product;
use App\Models\Customer;
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
    public function index()
    {
        $perPage = 10;
    
        // Lấy danh sách các kho và tính toán số lượng còn lại của sản phẩm trong từng kho
        $product_theokhos = Kho::where('Xoa', null)->get()->map(function ($kho) {
            // Tính tổng số lượng sản phẩm đã cho thuê từ kho này
            $totalRented = Chothue_Product::where('id_product_theokho', $kho->id)->sum('quantity');
    
            // Số lượng còn lại trong kho (tổng số lượng trong kho trừ đi số lượng đã cho thuê)
            $availableQuantity = $kho->quantity - $totalRented;
    
            // Gán giá trị còn lại vào kho để hiển thị trong view
            $kho->available_quantity = max(0, $availableQuantity); // Đảm bảo không âm
    
            return $kho;
        });
    
        // Lấy danh sách các hóa đơn cho thuê
        $chothues = Chothue::where('Xoa', null)->paginate($perPage);
    
        // Trả về view với dữ liệu đã tính toán
        return view('chothues.index', compact('chothues', 'product_theokhos'), [
            'title' => 'Cho thuê'
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input trước
        $this->validate($request, [
            'name_customer' => 'required',
            'phone_number' => 'required',
            'products' => 'required|array',
            'products.*.id_product_theokho' => 'required',
            'products.*.quantity' => 'required|integer|min:1',
            'so_ngay_thue' => 'required',
            'thanh_tien' => 'required',
            'khach_coc' => 'required'
        ], [
            'name_customer.required' => 'Vui lòng nhập tên khách hàng!',
            'phone_number.required' => 'Vui lòng nhập số điện thoại!',
            'products.required' => 'Vui lòng chọn sản phẩm!',
            'products.*.id_product_theokho.required' => 'Vui lòng chọn sản phẩm!',
            'products.*.quantity.required' => 'Vui lòng nhập số lượng!',
            'so_ngay_thue.required' => 'Vui lòng nhập số ngày thuê!',
            'thanh_tien.required' => 'Vui lòng nhập tổng tiền!',
            'khach_coc.required' => 'Vui lòng nhập số tiền khách cọc!'
        ]);
    
        // Kiểm tra xem khách hàng với số điện thoại đã tồn tại chưa
        $customer = Customer::where('phone_number', $request->phone_number)->first();
    
        if (!$customer) {
            $customer = new Customer;
            $customer->name = $request->name_customer;
            $customer->phone_number = $request->phone_number;
            $customer->save();
        }
    
        // Tạo mới hóa đơn cho thuê
        $chothue = new Chothue;
        $chothue->id_customer = $customer->id;
        $chothue->so_ngay_thue = $request->so_ngay_thue;
        $chothue->thanh_tien = $request->thanh_tien;
        $chothue->khach_coc = $request->khach_coc;
        $chothue->id_nhanvien = Auth::user()->id;
        $chothue->trangthai = 1;
        $chothue->save();
    
        // Lưu thông tin nhiều sản phẩm trong bảng Chothue_Product
        foreach ($request->products as $product) {
            // Tìm sản phẩm trong kho
            $kho = Kho::find($product['id_product_theokho']);
            $productDetail = $kho->Product;
    
            // Tính tổng số lượng sản phẩm đã có trong các kho (ngoại trừ kho hiện tại)
            $totalInStock = Kho::where('Xoa', null)
                                ->where('id_product', $productDetail->id)
                                ->sum('quantity');
    
            // Kiểm tra nếu số lượng yêu cầu thuê vượt quá số lượng còn lại
            $availableQuantity = $productDetail->quantity_origin - $totalInStock;
    
            if ($product['quantity'] > $availableQuantity) {
                return redirect()->back()->withErrors([
                    'quantity' => 'Số lượng sản phẩm (' . $productDetail->product_name . ') yêu cầu vượt quá số lượng còn lại trong kho! Bạn chỉ có thể thuê tối đa ' . $availableQuantity . ' cái.'
                ]);
            }
    
            // Lưu sản phẩm vào bảng Chothue_Product (không cập nhật số lượng kho)
            $chothueProduct = new Chothue_Product;
            $chothueProduct->id_chothue = $chothue->id;
            $chothueProduct->id_product_theokho = $product['id_product_theokho'];
            $chothueProduct->quantity = $product['quantity'];
            $chothueProduct->thanh_tien = $product['thanh_tien'];
            $chothueProduct->save();
        }
    
        return redirect()->back()->with('success', 'Cho thuê đã được thêm thành công!');
    }
    

    public function destroyProduct($id)
    {
        // Tìm sản phẩm trong bảng Chothue_Product bằng ID
        $chothueProduct = Chothue_Product::find($id);
    
        // Kiểm tra xem sản phẩm có tồn tại hay không
        if (!$chothueProduct) {
            return response()->json(['error' => 'Sản phẩm không tồn tại!'], 404);
        }
    
        // Xóa sản phẩm khỏi cơ sở dữ liệu
        $chothueProduct->delete();
    
        // Trả về phản hồi JSON sau khi xóa thành công
        return response()->json(['success' => 'Sản phẩm đã được xóa thành công!'], 200);
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
    
        // Lấy danh sách sản phẩm từ bảng chothue_products theo id_chothue
        $products = Chothue_Product::join('khos', 'chothue_products.id_product_theokho', '=', 'khos.id')
        ->join('products', 'khos.id_product', '=', 'products.id') // Kết nối bảng kho với bảng products
        ->where('chothue_products.id_chothue', $id)
        ->select('products.id as product_id', 'products.product_name','khos.title as title_kho', 'chothue_products.id as chothue_product_id', 'products.price_1_day', 'chothue_products.quantity', 'chothue_products.thanh_tien')
        ->get();
    
    
        // Trả về JSON bao gồm thông tin hóa đơn và danh sách sản phẩm
        return response()->json([
            'id' => $chothue->id,
            'customer' => [
                'name' => $customer->name,
                'phone_number' => $customer->phone_number
            ],
            'products' => $products, // Danh sách sản phẩm
            'so_ngay_thue' => $chothue->so_ngay_thue,
            'thanh_tien' => $chothue->thanh_tien,
            'khach_coc' => $chothue->khach_coc,
            'trangthai' => $chothue->trangthai, // Nếu có quan hệ 'trangthai'
            'nhanvien' => $chothue->nhanvien->name, // Nếu có quan hệ 'nhanvien'
            'updated_at' => $chothue->updated_at
        ]);
    }
    


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
            'products' => 'required|array',
            'products.*.id_product_theokho' => 'required',
            'products.*.quantity' => 'required|integer|min:1',
            'so_ngay_thue' => 'required',
            'thanh_tien' => 'required',
            'khach_coc' => 'required'
        ], [
            'name_customer.required' => 'Vui lòng nhập tên khách hàng!',
            'phone_number.required' => 'Vui lòng nhập số điện thoại!',
            'products.required' => 'Vui lòng chọn sản phẩm!',
            'products.*.id_product_theokho.required' => 'Vui lòng chọn sản phẩm!',
            'products.*.quantity.required' => 'Vui lòng nhập số lượng!',
            'so_ngay_thue.required' => 'Vui lòng nhập số ngày thuê!',
            'thanh_tien.required' => 'Vui lòng nhập tổng tiền!',
            'khach_coc.required' => 'Vui lòng nhập số tiền khách cọc!'
        ]);

        // Kiểm tra xem khách hàng với số điện thoại đã tồn tại chưa
        $customer = Customer::where('phone_number', $request->phone_number)->first();

        if (!$customer) {
            $customer = new Customer;
            $customer->name = $request->name_customer;
            $customer->phone_number = $request->phone_number;
            $customer->save();
        }

        // Tạo mới hóa đơn cho thuê
        $chothue->id_customer = $customer->id;
        $chothue->so_ngay_thue = $request->so_ngay_thue;
        $chothue->thanh_tien = $request->thanh_tien;
        $chothue->khach_coc = $request->khach_coc;
        $chothue->id_nhanvien = Auth::user()->id;
        $chothue->trangthai = $request->trangthai;
        $chothue->save();

        // Lưu thông tin nhiều sản phẩm trong bảng Chothue_Product
        foreach ($request->products as $product) {
            $chothueProduct = new Chothue_Product;
            $chothueProduct->id_chothue = $chothue->id;
            $chothueProduct->id_product_theokho = $product['id_product_theokho'];
            $chothueProduct->quantity = $product['quantity'];
            $chothueProduct->thanh_tien = $product['thanh_tien'];

            $chothueProduct->save();
        }

        return redirect()->back()->with('success', 'Cập nhật thành công!');
    
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
