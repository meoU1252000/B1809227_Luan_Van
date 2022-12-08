<?php

namespace App\Http\Controllers;

use App\Repositories\Order\OrderRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\OrderDetail;
use App\Models\Order;
use Carbon\Carbon;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct(OrderRepositoryInterface $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    public function index()
    {
        //
        // $orders = $this->orderRepo->getAll();
        $orders = Order::all()->sortByDesc('id');
        $i=1;
        return view('Admin.dist.creative.order.index',[
            'title'=>'Trang Quản Lý Đơn Hàng'
        ],compact('orders','i'));
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
        $order = $this->orderRepo->find($id);
        $order_details = OrderDetail::where('order_id',$id)->get();

        return view('Admin.dist.creative.order.edit',[
            'title'=>'Trang Quản Lý Đơn Hàng'
        ],compact('order','order_details'));
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
        $data = $request->all();
        $data['staff_id'] = Auth()->user()->id;
        if($data['order_status'] == "Đã Giao"){
            $data['receive_date'] = Carbon::now()->format('Y-m-d H:i:s');
        }else if($data['order_status'] == "Đã Hủy"){
            $order_details = OrderDetail::where('order_id',$data['id'])->get();
            $updateProduct= array();
            $updateProductSold = array();
            foreach($order_details as $order){
                $product_in_order = $order['product_number'];
                $product = Product::find($order['product_id']);
                $import_detail = ImportDetail::where('product_id', $product->id)->where('import_product_stock','>',0)->oldest()->first();
                $updateProductSold['import_product_stock'] = $import_detail['import_product_stock'] + $product_in_order;
                $updateProduct['product_quantity_stock'] = $product->product_quantity_stock + $product_in_order;
                $updateProduct['product_sold'] = $product->product_sold - $product_in_order;
                $update_product = $this->productRepo->update($product->id, $updateProduct);
                $update_import = $import_detail->update($updateProductSold);
            }
        }
        $update = $this->orderRepo->update($id,$data);
        return redirect()->route('order.index');
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
