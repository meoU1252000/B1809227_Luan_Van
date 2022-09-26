<?php

namespace App\Http\Controllers;

use App\Models\ProductPrice;
use Illuminate\Http\Request;
use App\Repositories\ProductPrice\ProductPriceRepositoryInterface;
use Carbon\Carbon;

class ProductPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $productPriceRepo;

    public function __construct(ProductPriceRepositoryInterface $productPriceRepo)
    {
        $this->productPriceRepo = $productPriceRepo;
    }


    public function index()
    {
        //
        $products_price = $this->productPriceRepo->getAll();

        return view('Admin.dist.creative.product.price.index', [
            'title' => 'Trang Quản Lý Giá Bán'
        ], compact('products_price'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $imports = $this->productPriceRepo->getImportAll();
        return view('Admin.dist.creative.product.price.add', [
            'title' => 'Trang Quản Lý Giá Bán'
        ], compact('imports'));
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
        $data = $request->all();
        $products_price = $this->productPriceRepo->create($data);
        return redirect()->route('price.index'); 
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
        $product_price = ProductPrice::find($id);
        return view('Admin.dist.creative.product.price.edit', [
            'title' => 'Trang Quản Lý Giá Bán'
        ], compact('product_price'));
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
        $product_price_old = ProductPrice::find($id);
        $product_price_new = $this->productPriceRepo->create($data);
        $update = $this->productPriceRepo->update($id,['date_end' => Carbon::now('Asia/Ho_Chi_Minh')]);
        return redirect()->route('price.index');
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
