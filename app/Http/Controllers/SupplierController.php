<?php

namespace App\Http\Controllers;
use App\Repositories\Supplier\SupplierRepositoryInterface;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $supplierRepo;

    public function __construct(SupplierRepositoryInterface $supplierRepo)
    {
        $this->supplierRepo = $supplierRepo;
    }

    public function index()
    {
        //
        $suppliers = $this->supplierRepo->getAll();

        return view('Admin.dist.creative.supplier.index', [
            'title' => 'Trang Quản Lý Nhà Cung Cấp'
        ], compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Admin.dist.creative.supplier.add', [
            'title' => 'Trang Quản Lý Nhà Cung Cấp'
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
        $supplier = $this->supplierRepo->create($data);
        return redirect()->route('supplier.index');
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
        $supplier = $this->supplierRepo->find($id);
        $statusSupplier = $this->supplierRepo->getStatusSupplier($id);
        $anotherStatus = $this->supplierRepo->getStatusSupplierExceptStatus($supplier->supplier_status);
        return view('Admin.dist.creative.supplier.edit', [
            'title' => 'Trang Quản Lý Nhà Cung Cấp'
        ], compact('supplier','statusSupplier','anotherStatus'));
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
        $supplier = $this->supplierRepo->update($id, $data);
        return redirect()->route('supplier.index');
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
        $supplier = $this->supplierRepo->delete($id);
        return redirect()->route('supplier.index');
    }
}
