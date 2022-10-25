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
use App\Repositories\Customer\CustomerRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Contracts\Auth\Authenticatable;
class ClientPageController extends AbstractApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(CustomerRepositoryInterface $cusRepo)
    {
        $this->cusRepo = $cusRepo;
    }
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

    public function register(Request $request){
        $data = $request->all();
        $validated =  Validator::make($data,[
            'customer_name' => 'required|',
            'customer_phone' => 'required|max:10',
            'email' => 'required|unique:customer,email',
            'password' => 'required|max:255',
        ]);
        if($validated->fails()) {
            $this->setStatusCode(JsonResponse::HTTP_BAD_REQUEST);
            $this->setStatus('error');
            $this->setMessage($validated->errors());
        }else{
            $data['password'] = Hash::make($data['password']);
            $customer_store = $this->cusRepo->create($data);
            $this->setStatusCode(JsonResponse::HTTP_OK);
            $this->setStatus('success');
            $this->setMessage('Create customer successful');
            $this->setData($customer_store);
        }
        return $this->respond();
    }

    public function login(Request $request){
        $validated =  Validator::make($request->all(), [
            'email' => 'required|email:filter|max:255|',
            'password' => 'required|max:255|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'
        ]);
        if($validated->fails()) {
            $this->setStatusCode(JsonResponse::HTTP_BAD_REQUEST);
            $this->setStatus('error');
            $this->setMessage($validated->errors());
            return $this->respond();
        }

        if (Auth::guard('api')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            $user = Auth::guard('api')->user();
            $this->setStatusCode(JsonResponse::HTTP_OK);
            $this->setStatus('success');
            $this->setMessage('Login successful');
            $this->setData($user);
            return $this->respond();
        };
    }

    public function logout()
    {
        Auth::guard('api')
            ->logout();
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
