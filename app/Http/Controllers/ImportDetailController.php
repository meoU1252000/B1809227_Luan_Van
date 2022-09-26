<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ImportDetails\ImportDetailsRepositoryInterface;
class ImportDetailController extends Controller
{
    protected $importDetailsRepo;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
     * PostController constructor.
     *
     * @param ImportDetailsRepositoryInterface $post
     */

    public function __construct(ImportDetailsRepositoryInterface $importDetailsRepo)
    {
        $this->importDetailsRepo = $importDetailsRepo;
    }

    public function index($id)
    {
        //
        // $import_details = $this->importDetailsRepo->getAll();
        $import = $this->importDetailsRepo->getImport($id);
        return view('Admin.dist.creative.import.details.index',[
            'title'=>'Trang Quản Lý Chi Tiết Nhập Hàng'
        ],compact('import'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $products = $this->importDetailsRepo->getProduct();
        $import = $this->importDetailsRepo->getImport($id);
        return view('Admin.dist.creative.import.details.add',[
            'title'=>'Trang Quản Lý Chi Tiết Nhập Hàng'
        ],compact('import','products'));
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
        $import_details = $this->importDetailsRepo->addImportDetails($data);
        return redirect()->route('import.details.index',['id' => $request->import_id]);
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
