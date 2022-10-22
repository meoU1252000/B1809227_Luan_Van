<?php

namespace App\Http\Controllers;

use App\Http\Resources\BrandResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\CategoryResource;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ClientPageController extends AbstractApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getListProducts()
    {
        //
        $products = ProductResource::collection(Product::all());
        // dd($products);
        $this->setStatusCode(JsonResponse::HTTP_OK);
        $this->setStatus('success');
        $this->setMessage('Get list products successful');
        $this->setData($products);
        return $this->respond();
    }

    public function getListCategories(){
        $categories = CategoryResource::collection(Category::all());
        // dd($categories);
        $this->setStatusCode(JsonResponse::HTTP_OK);
        $this->setStatus('success');
        $this->setMessage('Get list categories successful');
        $this->setData($categories);
        return $this->respond();
    }

    public function getListBrands(){
        $brands = BrandResource::collection(Brand::all());
        $this->setStatusCode(JsonResponse::HTTP_OK);
        $this->setStatus('success');
        $this->setMessage('Get list brands successful');
        $this->setData($brands);
        return $this->respond();
    }

    public function getCategory($name){
        $category = CategoryResource::collection(Category::where('category_name','=',$name)->get());
        $this->setStatusCode(JsonResponse::HTTP_OK);
        $this->setStatus('success');
        $this->setMessage('Get category successful');
        $this->setData($category);
        return $this->respond();
    }

    public function getProduct($id){
        $product = new ProductResource(Product::find($id));
        $this->setStatusCode(JsonResponse::HTTP_OK);
        $this->setStatus('success');
        $this->setMessage('Get product successful');
        $this->setData($product);
        return $this->respond();
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
