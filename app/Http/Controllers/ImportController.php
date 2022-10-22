<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Import\ImportRepositoryInterface;

class ImportController extends Controller
{
    protected $importRepo;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
     * PostController constructor.
     *
     * @param ImportRepositoryInterface $post
     */

    public function __construct(ImportRepositoryInterface $importRepo)
    {
        $this->importRepo = $importRepo;
    }

    public function index()
    {
        //
        $imports = $this->importRepo->getAll();
        $products = $this->importRepo->getProductExceptInMonth();
        return view('Admin.dist.creative.import.index',[
            'title'=>'Trang Quản Lý Nhập Hàng'
        ],compact('imports','products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $suppliers = $this->importRepo->getSupplier();
        $staffs = $this->importRepo->getStaff();
        return view('Admin.dist.creative.import.add',[
            'title'=>'Trang Quản Lý Nhập Hàng'
        ],compact('suppliers','staffs'));
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

        $import = $this->importRepo->create($data);

        return redirect()->route('import.index');
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
        $import = $this->importRepo->find($id);
        $suppliers = $this->importRepo->getSupplier();
        $staffs = $this->importRepo->getStaff();
        return view('Admin.dist.creative.import.edit',[
            'title'=>'Trang Quản Lý Nhập Hàng'
        ],compact('import','suppliers','staffs'));
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
        $import = $this->importRepo->update($id,$data);

        return redirect()->route('import.index');
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
        $import = $this->importRepo->delete($id);
        return redirect()->route('import.index');
    }
}
