<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Resources\BrandResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProvinceResource;
use App\Http\Resources\UserResource;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Customer_Address;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ImportDetail;
use App\Models\Product;
use App\Models\Province;
use App\Models\User;
use App\Repositories\Address\AddressRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\OrderDetails\OrderDetailsRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Rating\RatingRepositoryInterface;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Repositories\ImportDetails\ImportDetailsRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Mail\SendEmail;
use Illuminate\Validation\Rule;
class ClientPageController extends AbstractApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(ImportDetailsRepositoryInterface $importDetailRepo, CustomerRepositoryInterface $cusRepo, AddressRepositoryInterface $addressRepo, OrderDetailsRepositoryInterface $orderDetailsRepo,OrderRepositoryInterface $orderRepo, ProductRepositoryInterface $productRepo, RatingRepositoryInterface $ratingRepo,CommentRepositoryInterface $commentRepo)
    {
        $this->cusRepo = $cusRepo;
        $this->addressRepo = $addressRepo;
        $this->orderDetailsRepo = $orderDetailsRepo;
        $this->orderRepo = $orderRepo;
        $this->productRepo = $productRepo;
        $this->ratingRepo = $ratingRepo;
        $this->commentRepo = $commentRepo;
        $this->importDetailRepo = $importDetailRepo;
    }
    public function getListProducts()
    {
        //
        $products = ProductResource::collection(Product::where('product_status',1)->get());
        // dd($products);
        $this->setStatusCode(JsonResponse::HTTP_OK);
        $this->setStatus('success');
        $this->setMessage('Get list products successful');
        $this->setData($products);
        return $this->respond();
    }

    public function getListCategories(){
        $categories = CategoryResource::collection(Category::where('category_status',1)->get());
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

    public function login(AuthRequest $request){
        if (!$token = Auth::guard('api')->attempt($request->validated())) {
            $this->setStatusCode(JsonResponse::HTTP_BAD_REQUEST);
            $this->setStatus('error');
            $this->setMessage('Wrong username or password');
            return $this->respond();
        };
        $this->setStatusCode(JsonResponse::HTTP_OK);
        $this->setStatus('success');
        $this->setMessage('Login successful');
        $this->setData($this->createNewToken($token));
        return $this->respond();
    }

    public function changeInfo(Request $request){
        $data = $request->all();
        $customer = Customer::findOrFail(Auth::guard('api')->id());
        $validated =  Validator::make($data,[
            'customer_name' => 'required|',
            'customer_phone' => 'required|max:10',
            'email' => [
                'required',
                'email',
                Rule::unique('customer')->ignore($customer->id, 'id')
            ],
        ]);
        if($validated->fails()) {
            $this->setStatusCode(JsonResponse::HTTP_BAD_REQUEST);
            $this->setStatus('error');
            $this->setMessage($validated->errors());
        }else{
            $customer_update = $this->cusRepo->update($customer->id,$data);
            $this->setStatusCode(JsonResponse::HTTP_OK);
            $this->setStatus('success');
            $this->setMessage('Update customer information successful');
            // $token = Auth::guard('api')->attempt(['email' => $data['email']]);
            $this->setData($customer_update);
        }
        return $this->respond();
    }

    public function changePassword(Request $request){
        $data = $request->all();
        $customer = Customer::findOrFail(Auth::guard('api')->id());
        $validated =  Validator::make($data,[
            'password' => 'required|max:255',
        ]);
        if(Hash::check($data['old_password'], $customer->password)){
            $data['password'] = Hash::make($data['password']);
            $customer_update = $this->cusRepo->update($customer->id, $data);
            $this->setStatusCode(JsonResponse::HTTP_OK);
            $this->setStatus('success');
            $this->setMessage('Update customer information successful');
            $this->setData($customer_update);
        }else{
            $this->setStatusCode(JsonResponse::HTTP_BAD_REQUEST);
            $this->setStatus('error');
            $this->setMessage($validated->errors());
        }
        return $this->respond();
    }

    public function logout()
    {
        $this->setStatusCode(200);
        $this->setStatus('ok');
        $this->setMessage('logged_out');
        Auth::guard('api')->logout();
        return response()->json([
            'msg' => 'logged out'
        ]);
    }

     protected function createNewToken($token)
    {
        $user = Customer::findOrFail(Auth::guard('api')->id());
        return [
            'user' => new UserResource($user),
            'access_token' => $token,
            'token_type' => 'bearer',
        ];
    }

    public function getCustomerAddress(){
        $id = Auth::guard('api')->id();
        $address = Customer_Address::where('customer_id',$id)->get();
        $this->setStatusCode(JsonResponse::HTTP_OK);
        $this->setStatus('success');
        $this->setMessage('Get customer address successful');
        $this->setData($address);
        return $this->respond();

    }

    public function getListCity(){
        $cities = ProvinceResource::collection(Province::all());
        $this->setStatusCode(JsonResponse::HTTP_OK);
        $this->setStatus('success');
        $this->setMessage('Get list province successful');
        $this->setData($cities);
        return $this->respond();
    }

    public function createCustomerAddress(Request $request){
        $customer = Customer::findOrFail(Auth::guard('api')->id());
        $data = $request->all();
        $validated =  Validator::make($data,[
            'receiver_name' => 'required|max:255',
            'receiver_address' => 'required|max:255',
            'receiver_phone' => 'required|max:10',
        ]);
        if($validated->fails()) {
            $this->setStatusCode(JsonResponse::HTTP_BAD_REQUEST);
            $this->setStatus('error');
            $this->setMessage($validated->errors());
        }else{
            $data['customer_id'] = $customer->id;
            $addressStore = $this->addressRepo->create($data);
            $this->setStatusCode(JsonResponse::HTTP_CREATED);
            $this->setStatus('success');
            $this->setMessage('Create customer address successful');
            $this->setData($addressStore);
        }
        return $this->respond();
    }

    public function updateCustomerAddress(Request $request){
        $customer = Customer::findOrFail(Auth::guard('api')->id());
        $data = $request->all();
        $validated =  Validator::make($data,[
            'address_id' => 'required|exists:customer_address,id',
            'receiver_name' => 'required|max:255',
            'receiver_address' => 'required|max:255',
            'receiver_phone' => 'required|max:10',
        ]);
        if($validated->fails()) {
            $this->setStatusCode(JsonResponse::HTTP_BAD_REQUEST);
            $this->setStatus('error');
            $this->setMessage($validated->errors());
        }else{
            $data['customer_id'] = $customer->id;
            $addressStore = $this->addressRepo->update($request->address_id,$data);
            $this->setStatusCode(JsonResponse::HTTP_CREATED);
            $this->setStatus('success');
            $this->setMessage('Update customer address successful');
            $this->setData($addressStore);
        }
        return $this->respond();
    }

    public function deleteCustomerAddress(Request $request){
        $address = $this->addressRepo->delete($request->address_id);
        $this->setStatusCode(JsonResponse::HTTP_CREATED);
        $this->setStatus('success');
        $this->setMessage('Delete customer address successful');
        return $this->respond();
    }

    public function createOrder(Request $request){
        $customer = Customer::findOrFail(Auth::guard('api')->id());
        $data = $request->all();
        $validated =  Validator::make($data,[
            'address_id' => 'required|exists:customer_address,id',
            'total_price' => 'required|numeric',
            'cart_list' => 'array',
        ]);
        if($validated->fails()) {
            $this->setStatusCode(JsonResponse::HTTP_BAD_REQUEST);
            $this->setStatus('error');
            $this->setMessage($validated->errors());
        }else{
            $data['order_status'] = 'Chưa Xử Lý';
            $orderStore = $this->orderRepo->create($data);
            $value = array();
            $updateProductSold = array();
            foreach($data['cart_list'] as $cart){
                $value['order_id'] = $orderStore->id;
                $value['product_id'] = $cart['productId'];
                $product = Product::find($cart['productId']);
                $value['product_price'] = $product->product_price;
                $value['product_number'] = $cart['quantity'];
                $orderDetailStore = $this->orderDetailsRepo->create($value);
                $import_detail = ImportDetail::where('product_id', $product->id)->where('import_product_stock','>',0)->oldest()->first();
                // $updateProduct['product_quantity_stock'] = $product->product_quantity_stock - $value['product_number'];
                $updateProductSold['import_product_stock'] = $import_detail->import_product_stock - $value['product_number'];
                $updateProductNumber =  $import_detail->update($updateProductSold);
            }
            $this->setStatusCode(JsonResponse::HTTP_CREATED);
            $this->setStatus('success');
            $this->setMessage('Create order successful');
            $this->sendEmail($data['cart_list'],$orderStore);

            $this->setData($orderStore);
        }
        return $this->respond();
    }

    public function getOrders(){
        $customer = Customer::find(Auth::guard('api')->id());
        $customer_address = Customer_Address::where('customer_id',$customer->id)->get(['id']);
        $orders = Order::whereIn('address_id',$customer_address)->orderBy('id','DESC')->get();
        if(count($orders) > 0){
            $this->setData(OrderResource::collection($orders));
        }else{
            $this->setData(null);
        }
        $this->setStatusCode(JsonResponse::HTTP_OK);
        $this->setStatus('success');
        $this->setMessage('Get list order successful');
        return $this->respond();
    }

    public function cancelOrder(Request $request){
        $data = $request->all();
        // $order = Order::find($data['id']);
        $order_details = OrderDetail::where('order_id',$data['id'])->get();
        $data['order_status'] = "Đã Hủy";
        $updateProductSold = array();
        foreach($order_details as $order){
            $product_in_order = $order['product_number'];
            $product = Product::find($order['product_id']);
            // $product_quantity_stock = $product->product_quantity_stock;
            // $updateProduct['product_quantity_stock'] = $product_quantity_stock + $product_in_order;
            $import_detail = ImportDetail::where('product_id', $product->id)->where('import_product_stock','>',0)->oldest()->first();
            $updateProductSold['import_product_stock'] = $import_detail['import_product_stock'] + $product_in_order;
            // dd($updateProductSold);
            $update_product = $import_detail->update($updateProductSold);
        }
        $updateOrderStatus = $this->orderRepo->update($data['id'],$data);
        $this->setStatusCode(JsonResponse::HTTP_CREATED);
        $this->setStatus('success');
        $this->setMessage('Cancel order successful');
        $this->setData('');
        return $this->respond();

    }

    public function searchProducts(Request $request){
        $products = Product::where('product_name','LIKE','%' . $request->search .'%')->get();
        $this->setStatusCode(JsonResponse::HTTP_OK);
        $this->setStatus('success');
        $this->setMessage('Search product success');
        $this->setData(ProductResource::collection($products));
        return $this->respond();
    }

    public function ratingProduct(Request $request){
        $user = Customer::findOrFail(Auth::guard('api')->id());
        $data = $request->all();
        $data['customer_id'] = $user->id;
        $createRating = $this->ratingRepo->create($data);
        $this->setStatusCode(JsonResponse::HTTP_CREATED);
        $this->setStatus('success');
        $this->setMessage('Create rating success');
        $this->setData($createRating);
        return $this->respond();
    }

    public function commentProduct(Request $request){
        $user = Customer::findOrFail(Auth::guard('api')->id());
        $data = $request->all();
        $data['customer_id'] = $user->id;
        $createComment = $this->commentRepo->create($data);
        $this->setStatusCode(JsonResponse::HTTP_CREATED);
        $this->setStatus('success');
        $this->setMessage('Create comment success');
        $this->setData($createComment);
        return $this->respond();
    }

    public function deleteComment(Request $request){
        $data = $request->all();
        $deleteComment = $this->commentRepo->delete($data);
        $this->setStatusCode(JsonResponse::HTTP_CREATED);
        $this->setStatus('success');
        $this->setMessage('Delete comment success');
    }

    public function sendEmail($orders,$order_id){
        $user = Customer::findOrFail(Auth::guard('api')->id());
        $email = $user->email;
        $mailData = [
            'greeting' => 'Hi ' . $user->customer_name,
            'body' => $orders,
            'order_id' => $order_id->id,
            'total_price' => $order_id->total_price,
            'actiontext' => 'Liên hệ cửa hàng',
            'actionurl' => 'https://luanvan-frontend-datlestore.herokuapp.com/',
            'lastline' => 'Cảm ơn bạn đã mua hàng. Nếu có thắc mắc, vui lòng gọi: 0984978407',
        ];
        Mail::to($user->email)->send(new SendEmail($mailData));
        return $mailData;
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
