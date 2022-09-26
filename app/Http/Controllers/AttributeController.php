<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CategoryAttribute\CategoryAttributeRepositoryInterface;

class AttributeController extends Controller
{
    protected $categoryAttributeRepo;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(CategoryAttributeRepositoryInterface $categoryAttributeRepo)
    {
        $this->categoryAttributeRepo = $categoryAttributeRepo;
    }

    public function index()
    {
        //
        $categories = $this->categoryAttributeRepo->getCategory();

        return view('Admin.dist.creative.attribute.index',[
            'title'=>'Trang Quản Lý Thuộc Tính Danh Mục'
        ],compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = $this->categoryAttributeRepo->treeCategory();
        $count = 0;
        return view('Admin.dist.creative.attribute.add',[
            'title'=>'Trang Quản Lý Thuộc Tính Danh Mục'
        ],compact('categories','count'));
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
        // dd($data);
        $attribute = $this->categoryAttributeRepo->addAttributes($data);

        return redirect()->route('attribute.index');
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
        $category = $this->categoryAttributeRepo->getCategoryById($id);
        $i = 1;
        return view('Admin.dist.creative.attribute.edit',[
            'title'=>'Trang Quản Lý Thuộc Tính Danh Mục'
        ],compact('category','i'));
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
        $attribute = $this->categoryAttributeRepo->updateAttributes($data);

        return redirect()->route('attribute.index');
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
        $attribute = $this->categoryAttributeRepo->deleteAttributes($id);
        return redirect()->route('attribute.index');
    }
}
