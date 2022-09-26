<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProductFamily\ProductFamilyRepositoryInterface;
class ProductFamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $productFamilyRepo;

    public function __construct(ProductFamilyRepositoryInterface $productFamilyRepo)
    {
        $this->productFamilyRepo = $productFamilyRepo;
    }

    public function index()
    {
        //
        $product_families = $this->productFamilyRepo->getAll();
        return view('Admin.dist.creative.product.family.index', [
            'title' => 'Trang Quản Lý Nhóm Sản phẩm'
        ], compact('product_families')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Admin.dist.creative.product.family.add', [
            'title' => 'Trang Quản Lý Nhóm Sản phẩm'
        ]); 
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
        $product_family = $this->productFamilyRepo->create($data);
        return redirect()->route('family.index');
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
        $product_family = $this->productFamilyRepo->find($id);
        return view('Admin.dist.creative.product.family.edit', [
            'title' => 'Trang Quản Lý Nhóm Sản phẩm'
        ],compact('product_family')); 
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
        $product_family = $this->productFamilyRepo->update($id,$data);
        return redirect()->route('family.index');
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
        $product_family = $this->productFamilyRepo->delete($id);
        return redirect()->route('family.index');
    }
}
