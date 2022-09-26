<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Models\AttributeParams;
use App\Models\ImportDetail;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $productRepo;

    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function index()
    {
        $products = $this->productRepo->getAll();

        return view('Admin.dist.creative.product.index', [
            'title' => 'Trang Quản Lý Sản Phẩm'
        ], compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $brands = $this->productRepo->getBrandAll();
        $categories = $this->productRepo->treeCategory();
        $families = $this->productRepo->getFamilyAll();
        $count = 0;
        return view('Admin.dist.creative.product.add', [
            'title' => 'Trang Quản Lý Sản Phẩm'
        ], compact('brands', 'categories', 'count','families'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $srcImage = $request->file('main_image_src');
        $dir = 'img';
        $absolutePath = $srcImage->getClientOriginalName();
        $srcImage->move($dir, $absolutePath);
        $image_src = $dir . '/' . $absolutePath;
        $data['main_image_src'] = $image_src;

        $product = $this->productRepo->create($data);
        $attributes_params = $this->productRepo->addAttributes($product->id,$request->attribute_id,$request->attribute_value);
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->productRepo->find($id);
        $brands = $this->productRepo->getBrandExceptId($product->brand_id);
        $statusProduct = $this->productRepo->getStatusProduct($id);
        $anotherStatus = $this->productRepo->getStatusProductExceptStatus($product->product_status);
        $category_id = $product->get_category->id;
        $attributeNews = $this->productRepo->getAttributesNews($category_id);
        $families = $this->productRepo->getFamilyExceptId($product->product_family_id);
        // dd($product->product_status);
        return view('Admin.dist.creative.product.edit', [
            'title' => 'Trang Quản Lý Sản Phẩm'
        ], compact('product', 'brands', 'statusProduct', 'anotherStatus', 'category_id', 'attributeNews','families'));
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
        $data = $request->all();

        if ($request->file('main_image_src_new')) {
            $srcImage = $request->file('main_image_src_new');
            $dir = 'img';
            $absolutePath = $srcImage->getClientOriginalName();
            $srcImage->move($dir, $absolutePath);
            $image_src = $dir . '/' . $absolutePath;
            $data['main_image_src'] = $image_src;
        }
    
        $product = $this->productRepo->update($id, $data);
        $attribute = $this->productRepo->updateAttributes($id,$request->attribute_id_old,$request->attribute_id_new,$request->attribute_value);

        return redirect()->route('product.index');
    }

    public function getAttribute($id)
    {
        // dd($id);
        return $this->productRepo->getAttributesByCategoryId($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->productRepo->delete($id);

        return redirect()->route('product.index');
    }

    public function indexClient(){
        $products = $this->productRepo->getAll();
        $categories = $this->productRepo->getCategoryAll();
        return view('clients.index', [
            'title' => 'Trang Chủ'
        ], compact('products','categories'));
    }

    public function get_detail_product($slug,$id){
        // $product = Product::find($id);
        $product = $this->productRepo->find($id);
        $category_id = $product->get_category->id;
        // $attributes = Category_Attribute::where('category_id',$category_id)->get();
        $attributes = $this->productRepo->getAttribute($category_id);
        // dd($attributes);
        $categories = $this->productRepo->getCategoryTree();
        // $param_values = Attribute_Params::find($id);
        $brands = $this->productRepo->getBrandAll();
        $cartItems = $this->productRepo->getCart();
        $categories = $this->productRepo->getCategoryAll();
        $productCart = array();
        foreach($cartItems as $item){
            if($item->id == $id){
                array_push($productCart,$item);
                break;
            }
        }
       
        return view('clients.productDetails',[
            "title" => "Trang chi tiết sản phẩm"
        ],compact('product','categories','brands','attributes','productCart','categories'));
    }

    public function indexPrice(){
        $import_details = $this->productRepo->getImportDetailAll();
        return view('Admin.dist.creative.product.price.index', [
            'title' => 'Trang Quản Lý Giá Bán'
        ], compact('import_details'));
    }

    public function addPrice(){
        $imports = $this->productRepo->getImportAll();
        return view('Admin.dist.creative.product.price.add', [
            'title' => 'Trang Quản Lý Giá Bán'
        ], compact('imports'));
    }

    public function storePrice(Request $request){
        $data = $request->all();
        $product = $this->productRepo->update($request->product_id,$data);
        return redirect()->route('price.index');
    }

    public function getImport($id){
        $import = $this->productRepo->getImport($id);
        $import_details = $import->get_import_details;
        return response()->json(['code' => 200,'data' => $import_details]);
    }

    public function getProduct($id){
        $product = $this->productRepo->getProduct($id);
        return response()->json(['code' => 200,'data' => $product]);
    }

    public function getImportProductPrice(Request $request){
        $import_details = $this->productRepo->getImportPrice($request->all());
        return response()->json(['code' => 200,'data' => $import_details]);
    }

}
