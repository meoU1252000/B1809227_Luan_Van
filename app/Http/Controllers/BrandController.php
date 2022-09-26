<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Brand\BrandRepositoryInterface;


class BrandController extends Controller
{
    protected $brandRepo;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
     * PostController constructor.
     *
     * @param BrandRepositoryInterface $post
     */

    public function __construct(BrandRepositoryInterface $brandRepo)
    {
        $this->brandRepo = $brandRepo;
    }

    public function index()
    {
        //
        $brands = $this->brandRepo->getAll();

        return view('Admin.dist.creative.brand.index',[
            'title'=>'Trang Quản Lý Thương Hiệu'
        ],compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Admin.dist.creative.brand.add',[
            'title'=>'Trang Quản Lý Thương Hiệu'
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

        $brand = $this->brandRepo->create($data);

        return redirect()->route('brand.index');
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
        $brand = $this->brandRepo->find($id);
        return view('Admin.dist.creative.brand.edit',[
            'title'=>'Trang Quản Lý Thương Hiệu'
        ],compact('brand'));
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
        $brand = $this->brandRepo->update($id,$data);

        return redirect()->route('brand.index');
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
        $brand = $this->brandRepo->delete($id);
        return redirect()->route('brand.index');
    }
}
