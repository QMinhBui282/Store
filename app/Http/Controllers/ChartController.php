<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Purchar;
use Carbon\Carbon;

class ChartController extends Controller
{
    public function showChart($section)
    {
        // Khởi tạo mảng dữ liệu để truyền vào view
        $data = [];

        // Xử lý yêu cầu cho phần đã chọn
        switch ($section) {
            case 'sold':
                // Lấy tham số từ request
                $start_date = request()->input('start_date');
                $end_date = request()->input('end_date');

                // Truy vấn các đơn hàng đã bán trong khoảng thời gian yêu cầu
                $orders = Order::whereBetween('created_at', [$start_date, $end_date])->get();

                // Tính toán tổng doanh thu từ các đơn hàng đã bán
                $totalRevenue = $orders->sum(function ($order) {
                    return $order->receivedAmount() > $order->total() ? $order->total() : $order->receivedAmount();
                });

                // Gán dữ liệu tổng doanh thu vào mảng dữ liệu
                $data['totalRevenue'] = $totalRevenue;
                break;
            case 'purchased':
                // Xử lý yêu cầu cho phần nhập hàng nếu cần
                break;
            // Thêm các trường hợp xử lý yêu cầu cho các phần khác nếu cần
            default:
                // Xử lý mặc định hoặc thông báo lỗi khi không tìm thấy phần được chọn
                break;
        }

        // Trả về view hiển thị biểu đồ thống kê với dữ liệu tương ứng
        return view('charts.'.$section, $data);
    }
}
