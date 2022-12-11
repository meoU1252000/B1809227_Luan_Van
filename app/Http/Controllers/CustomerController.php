<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\Address\AddressRepositoryInterface;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Customer_Address;
use Carbon\Carbon;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(CustomerRepositoryInterface $cusRepo, AddressRepositoryInterface $addressRepo)
    {
        $this->cusRepo = $cusRepo;
        $this->addressRepo = $addressRepo;
    }
    public function index()
    {
        //
        $customers = $this->cusRepo->getAll();
        return view('Admin.dist.creative.customer.index',[
            'title'=>'Trang Quản Lý Khách Hàng'
        ],compact('customers'));
    }

    public function address($id){
        $addresses = Customer_Address::where('customer_id', $id)->get();
        return view('Admin.dist.creative.customer.address',[
            'title'=>'Trang Quản Lý Khách Hàng'
        ],compact('addresses'));
    }

    public function revenue($id){
        $customer = Customer::findOrFail($id);
        $customer_address = Customer_Address::where('customer_id', $id)->get(['id']);
        $order_waiting = Order::where('order_status','Chưa Xử Lý')->whereIn('address_id',$customer_address)->get()->count();
        $total_revenue = Order::where('order_status','Đã Giao')->whereIn('address_id',$customer_address)->sum('total_price');
        $today_revenue = Order::where('order_status','Đã Giao')->whereIn('address_id',$customer_address)->where('receive_date','>=',Carbon::now())->sum('total_price');
        $order_done = Order::where('order_status','Đã Giao')->whereIn('address_id',$customer_address)->get()->count();
        $total_order = Order::whereIn('address_id',$customer_address)->get()->count();
        $percent_order_done = $order_done/$total_order * 100;
        $this_year= Carbon::now('Asia/Ho_Chi_Minh')->startOfYear()->year;
        $case= DB::table('order as a')->join('order_details as b', 'a.id', '=', 'b.order_id')->selectRaw(
           "Sum(Case Month(a.receive_date) when 1 then b.product_price*b.product_number else 0 end) as T1,
            Sum(Case Month(a.receive_date) when 2 then  b.product_price*b.product_number else 0 end) as T2,
            Sum(Case Month(a.receive_date) when 3 then b.product_price*b.product_number else 0 end) as T3,
            Sum(Case Month(a.receive_date) when 4 then  b.product_price*b.product_number else 0 end) as T4,
            Sum(Case Month(a.receive_date) when 5 then b.product_price*b.product_number else 0 end) as T5,
            Sum(Case Month(a.receive_date) when 6 then  b.product_price*b.product_number else 0 end) as T6,
            Sum(Case Month(a.receive_date) when 7 then  b.product_price*b.product_number else 0 end) as T7,
            Sum(Case Month(a.receive_date) when 8 then  b.product_price*b.product_number else 0 end) as T8,
            Sum(Case Month(a.receive_date) when 9 then  b.product_price*b.product_number else 0 end) as T9,
            Sum(Case Month(a.receive_date) when 10 then  b.product_price*b.product_number else 0 end) as T10,
            Sum(Case Month(a.receive_date) when 11 then  b.product_price*b.product_number else 0 end) as T11,
            Sum(Case Month(a.receive_date) when 12 then  b.product_price*b.product_number else 0 end) as T12"
        )->where('a.order_status','Đã Giao')->whereIn('address_id',$customer_address)->whereYear('a.receive_date',$this_year)->get();
        $json_encode_case = json_encode($case);
        $json_decode = json_decode($json_encode_case,true);
        $row = $json_decode[0];
        $sum = 0;
        $data = array();
        foreach($row as $key => $value){
            $sum += $value;
            array_push($data,$value);
        }
        return view('Admin.dist.creative.customer.revenue',[
            'title'=>'Trang Quản Lý Khách Hàng'
        ],compact('order_waiting','total_revenue','today_revenue','order_done','percent_order_done','customer','data','sum'));
    }

    public function dashboard_filter($id,Request $request){
        $customer_address = Customer_Address::where('customer_id', $id)->get(['id']);
        $now = Carbon::now()->toDateString();
        $this_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->month;
        $previous_month = Carbon::now()->subMonth()->month;
        $this_year= Carbon::now('Asia/Ho_Chi_Minh')->startOfYear()->year;

        if($request['dashboard_value'] == 'thisweek'){
            $get= DB::table('order as a')->join('order_details as b', 'a.id', '=', 'b.order_id')->selectRaw(
                "Sum(Case WEEKDAY(a.receive_date) when 0 then b.product_price*b.product_number else 0 end) as N1,
                Sum(Case WEEKDAY(a.receive_date) when 1 then  b.product_price*b.product_number else 0 end) as N2,
                Sum(Case WEEKDAY(a.receive_date) when 2 then b.product_price*b.product_number else 0 end) as N3,
                Sum(Case WEEKDAY(a.receive_date) when 3 then  b.product_price*b.product_number else 0 end) as N4,
                Sum(Case WEEKDAY(a.receive_date) when 4 then b.product_price*b.product_number else 0 end) as N5,
                Sum(Case WEEKDAY(a.receive_date) when 5 then  b.product_price*b.product_number else 0 end) as N6,
                Sum(Case WEEKDAY(a.receive_date) when 6 then  b.product_price*b.product_number else 0 end) as N7"
             )->where('a.order_status','Đã Giao')->whereIn('address_id',$customer_address)->whereBetween('a.receive_date',[Carbon::now()->startOfWeek()->format('Y-m-d H:i:s'), Carbon::now()->endOfWeek()->format('Y-m-d H:i:s')])->get();
        }
        elseif($request['dashboard_value'] == 'weekago'){
            $get =DB::table('order as a')->join('order_details as b', 'a.id', '=', 'b.order_id')->selectRaw(
                "Sum(Case WEEKDAY(a.receive_date) when 0 then b.product_price*b.product_number else 0 end) as N1,
                Sum(Case WEEKDAY(a.receive_date) when 1 then  b.product_price*b.product_number else 0 end) as N2,
                Sum(Case WEEKDAY(a.receive_date) when 2 then b.product_price*b.product_number else 0 end) as N3,
                Sum(Case WEEKDAY(a.receive_date) when 3 then  b.product_price*b.product_number else 0 end) as N4,
                Sum(Case WEEKDAY(a.receive_date) when 4 then b.product_price*b.product_number else 0 end) as N5,
                Sum(Case WEEKDAY(a.receive_date) when 5 then  b.product_price*b.product_number else 0 end) as N6,
                Sum(Case WEEKDAY(a.receive_date) when 6 then  b.product_price*b.product_number else 0 end) as N7"
             )->where('a.order_status','Đã Giao')->whereIn('address_id',$customer_address)->whereBetween('a.receive_date',[Carbon::now()->subWeek()->startOfWeek()->format('Y-m-d H:i:s'),Carbon::now()->subWeek()->endOfWeek()->format('Y-m-d H:i:s')])->get();
        }
        elseif($request['dashboard_value'] == 'thismonth'){
            $get= DB::table('order as a')->join('order_details as b', 'a.id', '=', 'b.order_id')->selectRaw(
                "Sum(Case DAY(a.receive_date) when 1 then b.product_price*b.product_number else 0 end) as N1,
                Sum(Case DAY(a.receive_date) when 2 then  b.product_price*b.product_number else 0 end) as N2,
                Sum(Case DAY(a.receive_date) when 3 then b.product_price*b.product_number else 0 end) as N3,
                Sum(Case DAY(a.receive_date) when 4 then  b.product_price*b.product_number else 0 end) as N4,
                Sum(Case DAY(a.receive_date) when 5 then b.product_price*b.product_number else 0 end) as N5,
                Sum(Case DAY(a.receive_date) when 6 then  b.product_price*b.product_number else 0 end) as N6,
                Sum(Case DAY(a.receive_date) when 7 then  b.product_price*b.product_number else 0 end) as N7,
                Sum(Case DAY(a.receive_date) when 8 then  b.product_price*b.product_number else 0 end) as N8,
                Sum(Case DAY(a.receive_date) when 9 then  b.product_price*b.product_number else 0 end) as N9,
                Sum(Case DAY(a.receive_date) when 10 then  b.product_price*b.product_number else 0 end) as N10,
                Sum(Case DAY(a.receive_date) when 11 then  b.product_price*b.product_number else 0 end) as N11,
                Sum(Case DAY(a.receive_date) when 12 then  b.product_price*b.product_number else 0 end) as N12,
                Sum(Case DAY(a.receive_date) when 13 then b.product_price*b.product_number else 0 end) as N13,
                Sum(Case DAY(a.receive_date) when 14 then  b.product_price*b.product_number else 0 end) as N14,
                Sum(Case DAY(a.receive_date) when 15 then b.product_price*b.product_number else 0 end) as N15,
                Sum(Case DAY(a.receive_date) when 16 then  b.product_price*b.product_number else 0 end) as N16,
                Sum(Case DAY(a.receive_date) when 17 then b.product_price*b.product_number else 0 end) as N17,
                Sum(Case DAY(a.receive_date) when 18 then  b.product_price*b.product_number else 0 end) as N18,
                Sum(Case DAY(a.receive_date) when 19 then  b.product_price*b.product_number else 0 end) as N19,
                Sum(Case DAY(a.receive_date) when 20 then  b.product_price*b.product_number else 0 end) as N20,
                Sum(Case DAY(a.receive_date) when 21 then  b.product_price*b.product_number else 0 end) as N21,
                Sum(Case DAY(a.receive_date) when 22 then  b.product_price*b.product_number else 0 end) as N22,
                Sum(Case DAY(a.receive_date) when 23 then  b.product_price*b.product_number else 0 end) as N23,
                Sum(Case DAY(a.receive_date) when 24 then  b.product_price*b.product_number else 0 end) as N24,
                Sum(Case DAY(a.receive_date) when 25 then b.product_price*b.product_number else 0 end) as N25,
                Sum(Case DAY(a.receive_date) when 26 then  b.product_price*b.product_number else 0 end) as N26,
                Sum(Case DAY(a.receive_date) when 27 then  b.product_price*b.product_number else 0 end) as N27,
                Sum(Case DAY(a.receive_date) when 28 then  b.product_price*b.product_number else 0 end) as N28,
                Sum(Case DAY(a.receive_date) when 29 then  b.product_price*b.product_number else 0 end) as N29,
                Sum(Case DAY(a.receive_date) when 30 then  b.product_price*b.product_number else 0 end) as N30"
             )->where('a.order_status','Đã Giao')->whereIn('address_id',$customer_address)->whereMonth('a.receive_date',$this_month)->get();
        }
        elseif($request['dashboard_value'] == 'monthago'){
            $get= DB::table('order as a')->join('order_details as b', 'a.id', '=', 'b.order_id')->selectRaw(
                "Sum(Case DAY(a.receive_date) when 1 then b.product_price*b.product_number else 0 end) as N1,
                Sum(Case DAY(a.receive_date) when 2 then  b.product_price*b.product_number else 0 end) as N2,
                Sum(Case DAY(a.receive_date) when 3 then b.product_price*b.product_number else 0 end) as N3,
                Sum(Case DAY(a.receive_date) when 4 then  b.product_price*b.product_number else 0 end) as N4,
                Sum(Case DAY(a.receive_date) when 5 then b.product_price*b.product_number else 0 end) as N5,
                Sum(Case DAY(a.receive_date) when 6 then  b.product_price*b.product_number else 0 end) as N6,
                Sum(Case DAY(a.receive_date) when 7 then  b.product_price*b.product_number else 0 end) as N7,
                Sum(Case DAY(a.receive_date) when 8 then  b.product_price*b.product_number else 0 end) as N8,
                Sum(Case DAY(a.receive_date) when 9 then  b.product_price*b.product_number else 0 end) as N9,
                Sum(Case DAY(a.receive_date) when 10 then  b.product_price*b.product_number else 0 end) as N10,
                Sum(Case DAY(a.receive_date) when 11 then  b.product_price*b.product_number else 0 end) as N11,
                Sum(Case DAY(a.receive_date) when 12 then  b.product_price*b.product_number else 0 end) as N12,
                Sum(Case DAY(a.receive_date) when 13 then b.product_price*b.product_number else 0 end) as N13,
                Sum(Case DAY(a.receive_date) when 14 then  b.product_price*b.product_number else 0 end) as N14,
                Sum(Case DAY(a.receive_date) when 15 then b.product_price*b.product_number else 0 end) as N15,
                Sum(Case DAY(a.receive_date) when 16 then  b.product_price*b.product_number else 0 end) as N16,
                Sum(Case DAY(a.receive_date) when 17 then b.product_price*b.product_number else 0 end) as N17,
                Sum(Case DAY(a.receive_date) when 18 then  b.product_price*b.product_number else 0 end) as N18,
                Sum(Case DAY(a.receive_date) when 19 then  b.product_price*b.product_number else 0 end) as N19,
                Sum(Case DAY(a.receive_date) when 20 then  b.product_price*b.product_number else 0 end) as N20,
                Sum(Case DAY(a.receive_date) when 21 then  b.product_price*b.product_number else 0 end) as N21,
                Sum(Case DAY(a.receive_date) when 22 then  b.product_price*b.product_number else 0 end) as N22,
                Sum(Case DAY(a.receive_date) when 23 then  b.product_price*b.product_number else 0 end) as N23,
                Sum(Case DAY(a.receive_date) when 24 then  b.product_price*b.product_number else 0 end) as N24,
                Sum(Case DAY(a.receive_date) when 25 then b.product_price*b.product_number else 0 end) as N25,
                Sum(Case DAY(a.receive_date) when 26 then  b.product_price*b.product_number else 0 end) as N26,
                Sum(Case DAY(a.receive_date) when 27 then  b.product_price*b.product_number else 0 end) as N27,
                Sum(Case DAY(a.receive_date) when 28 then  b.product_price*b.product_number else 0 end) as N28,
                Sum(Case DAY(a.receive_date) when 29 then  b.product_price*b.product_number else 0 end) as N29,
                Sum(Case DAY(a.receive_date) when 30 then  b.product_price*b.product_number else 0 end) as N30"
             )->where('a.order_status','Đã Giao')->whereIn('address_id',$customer_address)->whereMonth('a.receive_date', $previous_month)->get();
        }
        else if($request['dashboard_value'] == 'thisyear'){
            $get= DB::table('order as a')->join('order_details as b', 'a.id', '=', 'b.order_id')->selectRaw(
               "Sum(Case Month(a.receive_date) when 1 then b.product_price*b.product_number else 0 end) as T1,
                Sum(Case Month(a.receive_date) when 2 then  b.product_price*b.product_number else 0 end) as T2,
                Sum(Case Month(a.receive_date) when 3 then b.product_price*b.product_number else 0 end) as T3,
                Sum(Case Month(a.receive_date) when 4 then  b.product_price*b.product_number else 0 end) as T4,
                Sum(Case Month(a.receive_date) when 5 then b.product_price*b.product_number else 0 end) as T5,
                Sum(Case Month(a.receive_date) when 6 then  b.product_price*b.product_number else 0 end) as T6,
                Sum(Case Month(a.receive_date) when 7 then  b.product_price*b.product_number else 0 end) as T7,
                Sum(Case Month(a.receive_date) when 8 then  b.product_price*b.product_number else 0 end) as T8,
                Sum(Case Month(a.receive_date) when 9 then  b.product_price*b.product_number else 0 end) as T9,
                Sum(Case Month(a.receive_date) when 10 then  b.product_price*b.product_number else 0 end) as T10,
                Sum(Case Month(a.receive_date) when 11 then  b.product_price*b.product_number else 0 end) as T11,
                Sum(Case Month(a.receive_date) when 12 then  b.product_price*b.product_number else 0 end) as T12"
            )->where('a.order_status','Đã Giao')->whereIn('address_id',$customer_address)->whereYear('a.receive_date',$this_year)->get();
        }
        $json_encode_case = json_encode($get);
        $json_decode = json_decode($json_encode_case,true);
        $row = $json_decode[0];
        $data = array();
        foreach($row as $key => $value){
            array_push($data,$value);
        }
        return response()->json(['code' => 200,'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
