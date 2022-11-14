<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Category\CategoryRepositoryInterface;


class CategoryController extends Controller
{
    protected $categoryRepo;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function index()
    {
        //
        $categories = $this->categoryRepo->getAll();

        return view('Admin.dist.creative.category.index',[
            'title'=>'Trang Quản Lý Danh Mục'
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
        $categories = $this->categoryRepo->treeCategory();
        $count = 0;
        return view('Admin.dist.creative.category.add',[
            'title'=>'Trang Quản Lý Danh Mục'
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
        $category = $this->categoryRepo->create($data);

        return redirect()->route('category.index');
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
        $categoryEdit = $this->categoryRepo->find($id);
        $categories = $this->categoryRepo->treeCategory();
        $count = 0;
        return view('Admin.dist.creative.category.edit',[
            'title'=>'Trang Quản Lý Thương Hiệu'
        ],compact('categoryEdit','categories','count'));
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
        $category = $this->categoryRepo->update($id,$data);

        return redirect()->route('category.index');
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
        $category = $this->categoryRepo->delete($id);
        return redirect()->route('category.index');
    }

    public function activeSwitch(Request $request){
        $data = $request->all();
        $category = $this->categoryRepo->update($request->id,$data);

        if(!$category){
            return response()->json(['code' => 400]);
        }
        return response()->json(['code' => 200]);
    }
}
