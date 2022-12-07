<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ReveunueResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Carbon\Carbon;
use App\Models\ProductPrice;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminPage(Request $request){
        $user = auth()->user();
        $product_statistical =  collect(ReveunueResource::collection(Product::take(10)->get())->resolve())->sortByDesc('total_price');
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
        )->where('a.order_status','Đã Giao')->whereYear('a.receive_date',$this_year)->get();
        $json_encode_case = json_encode($case);
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

        $products = Product::all();

        return view('Admin.dist.creative.home',[
            'title'=>'Trang Chủ'
        ],compact('user','products','product_statistical','sum','data','row','total_price_day','total_product','order_waiting','total_staff'));
    }

    public function dashboard_filter(Request $request){
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
             )->where('a.order_status','Đã Giao')->whereBetween('a.receive_date',[Carbon::now()->startOfWeek()->format('Y-m-d H:i:s'), Carbon::now()->endOfWeek()->format('Y-m-d H:i:s')])->get();
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
             )->where('a.order_status','Đã Giao')->whereBetween('a.receive_date',[Carbon::now()->subWeek()->startOfWeek()->format('Y-m-d H:i:s'),Carbon::now()->subWeek()->endOfWeek()->format('Y-m-d H:i:s')])->get();
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
             )->where('a.order_status','Đã Giao')->whereMonth('a.receive_date',$this_month)->get();
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
             )->where('a.order_status','Đã Giao')->whereMonth('a.receive_date', $previous_month)->get();
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
            )->where('a.order_status','Đã Giao')->whereYear('a.receive_date',$this_year)->get();
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

    public function product_filter(Request $request){
        $now = Carbon::now()->toDateString();
        $this_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->month;
        $previous_month = Carbon::now()->subMonth()->month;
        $this_year= Carbon::now('Asia/Ho_Chi_Minh')->startOfYear()->year;
        if($request['filter_value'] == 'thisweek'){
            // $get= DB::table('order as a')->join('order_details as b', 'a.id', '=', 'b.order_id')->select(
            //     "b.product_id"
            //  )->where('a.order_status','Đã Giao')->whereBetween('a.receive_date',[Carbon::now()->startOfWeek()->format('Y-m-d H:i:s'), Carbon::now()->endOfWeek()->format('Y-m-d H:i:s')])->pluck('b.product_id');
            $order = Order::where('order_status','Đã Giao')->whereBetween('receive_date',[Carbon::now()->startOfWeek()->format('Y-m-d H:i:s'), Carbon::now()->endOfWeek()->format('Y-m-d H:i:s')])->pluck('id');
            $order_details = OrderDetail::whereIn('order_id',$order)->get();
            // $data = array();
            // foreach($order_details as $order_detail){
            //     $product = Product::find($order_detail->product_id);
            //     $value = [
            //         "id" => $order_detail->product_id,
            //         "product_name" => $product->product_name,
            //         "product_price" => $order_detail->product_price,
            //         "product_quantity" => $order_detail->product_number,
            //         "total_price" => $order_detail->product_price*$order_detail->product_number,
            //     ];
            //     array_push($data, $value);
            // }
            // return response()->json(['code' => 200,'data' => $data]);
        }
        elseif($request['filter_value'] == 'weekago'){
            // $get =DB::table('order as a')->join('order_details as b', 'a.id', '=', 'b.order_id')->select(
            //     "b.product_id"
            //  )->where('a.order_status','Đã Giao')->whereBetween('a.created_at',[Carbon::now()->subWeek()->startOfWeek()->format('Y-m-d H:i:s'),Carbon::now()->subWeek()->endOfWeek()->format('Y-m-d H:i:s')])->pluck('b.product_id');
            $order = Order::where('order_status','Đã Giao')->whereBetween('receive_date',[Carbon::now()->subWeek()->startOfWeek()->format('Y-m-d H:i:s'),Carbon::now()->subWeek()->endOfWeek()->format('Y-m-d H:i:s')])->pluck('id');
            $order_details = OrderDetail::whereIn('order_id',$order)->get();

        }
        elseif($request['filter_value'] == 'thismonth'){
            // $get= DB::table('order as a')->join('order_details as b', 'a.id', '=', 'b.order_id')->select(
            //     "b.product_id"
            //  )->where('a.order_status','Đã Giao')->whereMonth('a.created_at',$this_month)->pluck('b.product_id');
            $order = Order::where('order_status','Đã Giao')->whereMonth('receive_date',$this_month)->pluck('id');
            $order_details = OrderDetail::whereIn('order_id',$order)->get();
        }
        elseif($request['filter_value'] == 'monthago'){
            // $get= DB::table('order as a')->join('order_details as b', 'a.id', '=', 'b.order_id')->select(
            //     "b.product_id"
            //  )->where('a.order_status','Đã Giao')->whereMonth('a.receive_date', $previous_month)->pluck('b.product_id');
            $order = Order::where('order_status','Đã Giao')->whereMonth('receive_date',$previous_month)->pluck('id');
            $order_details = OrderDetail::whereIn('order_id',$order)->get();
        }
        else if($request['filter_value'] == 'thisyear'){
            // $get= DB::table('order as a')->join('order_details as b', 'a.id', '=', 'b.order_id')->select(
            //     "b.product_id"
            //  )->where('a.order_status','Đã Giao')->whereYear('a.receive_date', $this_year)->pluck('b.product_id');
            // $product_statistical =  collect(ReveunueResource::collection(Product::whereIn('id',$get->toArray())->take(10)->get())->resolve())->sortByDesc('total_price');
            // return response()->json(['code' => 200,'data' => array_values($product_statistical->toArray())]);
            $order = Order::where('order_status','Đã Giao')->whereYear('receive_date',$this_year)->pluck('id');
            $order_details = OrderDetail::whereIn('order_id',$order)->get();
        }else{
            $order = Order::where('order_status','Đã Giao')->pluck('id');
            $order_details = OrderDetail::whereIn('order_id',$order)->get();
            //  $product_statistical =  collect(ReveunueResource::collection(Product::take(10)->get())->resolve())->sortByDesc('total_price');
            //  return response()->json(['code' => 200,'data' => array_values($product_statistical->toArray())]);
        }
        // $product_statistical =  collect(ReveunueResource::collection(Product::whereIn('id',$get->toArray())->take(10)->get())->resolve())->sortByDesc('total_price');
        // return response()->json(['code' => 200,'data' => array_values($product_statistical->toArray())]);
        $data = array();
        $array_product = array();
        foreach($order_details as $order_detail){
            $product = Product::find($order_detail->product_id);
            if(in_array($product->id,$array_product)){
                $index = array_search($product->id, array_column($data, 'id'));
                $data[$index]['product_quantity'] +=$order_detail->product_number;
                $data[$index]['total_price'] +=$order_detail->product_price*$order_detail->product_number;
            }else{
                array_push($array_product,$product->id);
                $value = [
                    "id" => $order_detail->product_id,
                    "product_name" => $product->product_name,
                    "product_price" => $order_detail->product_price,
                    "product_quantity" => $order_detail->product_number,
                    "total_price" => $order_detail->product_price*$order_detail->product_number,
                ];
                array_push($data, $value);
            }
        }
        return response()->json(['code' => 200,'data' => $data]);
    }

    public function product_statistical(Request $request){

        //format date start

        $date_start = strtok($request->filter,"&");
        $date_start =(substr($date_start, strpos($date_start, "=") + 1));
        if($date_start != ''){
            $date_start = str_replace('%2', '/', $date_start);
            $date_start = str_replace('F', '', $date_start);
            $date_start = date('Y-m-d', strtotime($date_start));
        }

        //format date end
        $date_end = (substr($request->filter, strpos($request->filter, "&") + 1));
        $date_end = strtok($date_end,"&");
        $date_end =(substr($date_end, strpos($date_end, "=") + 1));
        if($date_end != ''){
            $date_end = str_replace('%2', '/', $date_end);
            $date_end = str_replace('F', '', $date_end);
            $date_end = date('Y-m-d', strtotime($date_end));
        }


        //get product search
        $search_product = substr(strrchr($request->filter, "&"), 1);
        $search_product = (substr($search_product, strpos($search_product, "=") + 1));
        $search_product = str_replace('%20', ' ', $search_product);

        if($search_product != ''){
            $products = Product::where('product_name','LIKE', '%'. $search_product . '%')->orWhere('id','LIKE', '%'. $search_product . '%')->get();
            $data = array();

            foreach($products as $product){
                // $product_turnover =DB::table('order as a')->join('order_details as b', 'a.id', '=', 'b.order_id')->selectRaw("Sum(b.product_price*b.product_number) as product_turnover")->where('product_id', $product->id)->get();
                // $product_turnover = json_decode(json_encode($product_turnover[0]),true);
                if($date_start != '' && $date_start !=''){
                    $cost_prices = DB::table('import_details')->selectRaw('import_id,import_product_quantity,import_price,import_product_stock,import_price_sell,Sum(import_product_quantity*import_price) as cost_price')->groupBy('import_id','import_product_quantity','import_price','import_product_stock','import_price_sell')->where('product_id', $product->id)->whereBetween('created_at', [$date_start, $date_end])->get();
                }else{
                    $cost_prices = DB::table('import_details')->selectRaw('import_id,import_product_quantity,import_price,import_product_stock,import_price_sell,Sum(import_product_quantity*import_price) as cost_price')->groupBy('import_id','import_product_quantity','import_price','import_product_stock','import_price_sell')->where('product_id', $product->id)->get();
                }

                $cost_prices = json_decode(json_encode($cost_prices),true);
                if(isset($cost_prices[0])){
                    foreach($cost_prices as $cost_price){
                        if($cost_price['import_product_stock'] != null) {
                            $value = [
                                "id" => $product->id,
                                "import_id" => $cost_price['import_id'],
                                "import_product_quantity" => $cost_price['import_product_quantity'],
                                "import_price" => $cost_price['import_price'],
                                "product_name" => $product->product_name,
                                "cost_price" => $cost_price['cost_price'],
                                "sell_price" => $cost_price['import_price_sell'],
                                'product_sold' =>($cost_price['import_product_quantity'] - $cost_price['import_product_stock']),
                                "product_turnover" => ($cost_price['import_product_quantity'] - $cost_price['import_product_stock']) * $cost_price['import_price_sell'],
                                "total_price" => ($cost_price['import_product_quantity'] - $cost_price['import_product_stock']) * $cost_price['import_price_sell'] - $cost_price['cost_price'],
                            ];
                        }else{
                            $value = [
                                "id" => $product->id,
                                "import_id" => $cost_price['import_id'],
                                "import_product_quantity" => $cost_price['import_product_quantity'],
                                "import_price" => $cost_price['import_price'],
                                "product_name" => $product->product_name,
                                "cost_price" => $cost_price['cost_price'],
                                "sell_price" => $cost_price['import_price_sell'],
                                'product_sold' => 0,
                                "product_turnover" => -($cost_price['import_product_quantity']  * $cost_price['import_price_sell']),
                                "total_price" => -($cost_price['import_product_quantity']  * $cost_price['import_price_sell']),
                            ];
                        }
                        array_push($data,$value);
                    }
                }else{
                    $value = [
                        "id" => $product->id,
                        "import_id" => "Chưa nhập hàng",
                        "import_product_quantity" => 0,
                        "import_price" => 0,
                        "product_name" => $product->product_name,
                        "cost_price" => 0,
                        "sell_price" => 0,
                        'product_sold' =>0,
                        "product_turnover" => 0,
                        "total_price" => 0,
                    ];
                    array_push($data,$value);
                }
            }
            return response()->json(['code' => 200,'data' => $data]);
        }else{
            $data = [
                "id" => '',
                "import_id" => "",
                "import_product_quantity" => 0,
                "import_price" => 0,
                "product_name" => 'No data',
                "cost_price" => 0,
                "sell_price" => 0,
                'product_sold' =>0,
                "product_turnover" => 0,
                "total_price" => 0,
            ];
            return response()->json(['code' => 200,'data' => $data]);
        }

    }
}
