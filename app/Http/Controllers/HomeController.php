<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ReveunueResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminPage(){
        $user = auth()->user();
        $product_statistical =  collect(ReveunueResource::collection(Product::take(10)->get())->resolve())->sortByDesc('total_price');
        $this_year= Carbon::now('Asia/Ho_Chi_Minh')->startOfYear()->year;
        $case_month= DB::table('order as a')->join('order_details as b', 'a.id', '=', 'b.order_id')->selectRaw(
           "Sum(Case Month(a.created_at) when 1 then b.product_price*b.product_number else 0 end) as T1,
            Sum(Case Month(a.created_at) when 2 then  b.product_price*b.product_number else 0 end) as T2,
            Sum(Case Month(a.created_at) when 3 then b.product_price*b.product_number else 0 end) as T3,
            Sum(Case Month(a.created_at) when 4 then  b.product_price*b.product_number else 0 end) as T4,
            Sum(Case Month(a.created_at) when 5 then b.product_price*b.product_number else 0 end) as T5,
            Sum(Case Month(a.created_at) when 6 then  b.product_price*b.product_number else 0 end) as T6,
            Sum(Case Month(a.created_at) when 7 then  b.product_price*b.product_number else 0 end) as T7,
            Sum(Case Month(a.created_at) when 8 then  b.product_price*b.product_number else 0 end) as T8,
            Sum(Case Month(a.created_at) when 9 then  b.product_price*b.product_number else 0 end) as T9,
            Sum(Case Month(a.created_at) when 10 then  b.product_price*b.product_number else 0 end) as T10,
            Sum(Case Month(a.created_at) when 11 then  b.product_price*b.product_number else 0 end) as T11,
            Sum(Case Month(a.created_at) when 12 then  b.product_price*b.product_number else 0 end) as T12"
        )->where('a.order_status','Đã Giao')->whereYear('a.created_at',$this_year)->get();

        $json_encode_case = json_encode($case_month);
        $json_decode = json_decode($json_encode_case,true);
        $row = $json_decode[0];
        $sum = 0;
        $data = array();
        foreach($row as $key => $value){
            $sum += $value;
            array_push($data,$value);
        }
        $this_day = Carbon::now()->toDateTimeString();
        $case_day = Order::where('created_at',$this_day)->get();
        $total_price_day = 0;
        $total_product = Product::where('product_status','1')->get()->count();
        $order_waiting = Order::where('order_status','Chưa Xử Lý')->get()->count();
        $total_staff = User::where('status','1')->get()->count();
        foreach($case_day as $day){
            $total_price_day += $day->total_price;
        }

        return view('Admin.dist.creative.home',[
            'title'=>'Trang Chủ'
        ],compact('user','product_statistical','sum','data','row','total_price_day','total_product','order_waiting','total_staff'));
    }

    public function dashboard_filter(){
        $now = Carbon::now()->toDateString();
        $this_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $previous_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        // $previous_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $seven_day_ago = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $this_year= Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
        if($data['dashboard_value'] == '7dayago'){
            $get = Order::whereBetween('receive_date',[$sub7days,$now])->orderBy('order_date','ASC')->get();
        }
        elseif($data['dashboard_value'] == 'previousmonth'){
            $get = Order::whereBetween('receive_date',[$previous_month,$now])->orderBy('order_date','ASC')->get();
        }
        elseif($data['dashboard_value'] == 'thismonth'){
            $get = Order::whereBetween('receive_date',[$this_month,$now])->orderBy('order_date','ASC')->get();
        }
        else{
            $get = Order::whereBetween('receive_date',[$this_year,$now])->orderBy('order_date','ASC')->get();
        }
        // foreach($get as $key => $val){
        //     $chart_data[] = array(

        //     )
        // }
    }
}
