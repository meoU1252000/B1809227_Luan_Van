<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Image\ImageRepositoryInterface;
class ImageController extends Controller
{
    protected $imageRepo;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     /**
     * PostController constructor.
     *
     * @param ImageRepositoryInterface $post
     */

    public function __construct(ImageRepositoryInterface $imageRepo)
    {
        $this->imageRepo = $imageRepo;
    }
    public function index($id)
    {
        //
        $product = $this->imageRepo->getProduct($id);
        return view('Admin.dist.creative.product.image.index',[
            'title'=>'Trang Quản Lý Hình Ảnh Sản Phẩm'
        ],compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $product = $this->imageRepo->getProduct($id);
        return view('Admin.dist.creative.product.image.add',[
            'title'=>'Trang Quản Lý Hình Ảnh Sản Phẩm'
        ],compact('product'));
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
        $srcImage = $request->file('product_src');
        $dir = 'img';
        $absolutePath = $srcImage->getClientOriginalName();
        $srcImage->move($dir, $absolutePath);
        $image_src = $dir . '/' . $absolutePath;
        $data['product_src'] = $image_src;
        $image = $this->imageRepo->create($data);
        return redirect()->route('image.index',['id'=>$request->product_id]);
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
    public function edit($id,$image)
    {
        //
        $product = $this->imageRepo->getProduct($id);
        $image = $this->imageRepo->find($image);
        return view('Admin.dist.creative.product.image.edit',[
            'title'=>'Trang Quản Lý Hình Ảnh Sản Phẩm'
        ],compact('product','image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,$image)
    {
        //
        $data = $request->all();

        if ($request->file('product_src_new')) {
            $srcImage = $request->file('product_src_new');
            $dir = 'img';
            $absolutePath = $srcImage->getClientOriginalName();
            $srcImage->move($dir, $absolutePath);
            $image_src = $dir . '/' . $absolutePath;
            $data['product_src'] = $image_src;
            $image_new = $this->imageRepo->update($image,$data);
        }
        return redirect()->route('image.index',['id'=>$request->product_id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$image)
    {
        //
        $product = $this->imageRepo->getProduct($id);
        $destroy = $this->imageRepo->delete($image);
        return redirect()->route('image.index',['id'=>$product->id]);

    }
}
