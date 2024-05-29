<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Purchar;
use App\Models\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $interval = $request->input('interval', 'day');

        // Default date range is the last 30 days if no date is provided
        if (!$start_date || !$end_date) {
            $start_date = Carbon::now()->subDays(30)->format('Y-m-d');
            $end_date = Carbon::now()->format('Y-m-d');
        }

        // Convert to Carbon instances
        $start_date = Carbon::parse($start_date)->startOfDay();
        $end_date = Carbon::parse($end_date)->endOfDay();

        // Query orders and purchars within the date range
        $orders = Order::with(['items', 'payments'])->whereBetween('created_at', [$start_date, $end_date])->get();
        $purchars = Purchar::with(['items', 'paymentpurs'])->whereBetween('created_at', [$start_date, $end_date])->get();
        $customers_count = Customer::count();

        return view('home', [
            'orders_count' => $orders->count(),
            'income' => $orders->map(function($i) {
                if($i->receivedAmount() > $i->total()) {
                    return $i->total();
                }
                return $i->receivedAmount();
            })->sum(),
            'incomecus' => $orders->map(function($i) {
                if($i->receivedAmount() > $i->total()) {
                    return $i->total();
                }
                return $i->total() - $i->receivedAmount();
            })->sum(),
            'purchars_count' => $purchars->count(),
            'incomep' => $purchars->map(function($i) {
                if($i->receivedAmount() > $i->total()) {
                    return $i->total();
                }
                return $i->receivedAmount();
            })->sum(),
            'incomepur' => $purchars->map(function($i) {
                return ($i->total() - $i->receivedAmount());
            })->sum(),
            'income_today' => $orders->where('created_at', '>=', date('Y-m-d').' 00:00:00')->map(function($i) {
                if($i->receivedAmount() > $i->total()) {
                    return $i->total();
                }
                return $i->receivedAmount();
            })->sum(),
            'customers_count' => $customers_count
        ]);
    }
}
