<?php

namespace App\Http\Controllers;

use App\Repositories\Auth\AuthRepositoryInterface;
use App\Repositories\Staff\StaffRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $staffRepo;
    protected $userRepo;

    public function __construct(StaffRepositoryInterface $staffRepo, AuthRepositoryInterface $userRepo)
    {
        $this->staffRepo = $staffRepo;
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        //
        $staffs = $this->staffRepo->getAll();

        return view('Admin.dist.creative.staff.index', [
            'title' => 'Trang Quản Lý Nhân Viên'
        ], compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Admin.dist.creative.staff.add', [
            'title' => 'Trang Quản Lý Nhân Viên'
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
        $data = $request->all();
        DB::beginTransaction();
        try {
            $data['password'] = Hash::make('Hacker1252000!');
            $staff = $this->staffRepo->create($data);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }

        return redirect()->route('staff.index');
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
        //
        $staff = $this->staffRepo->find($id);
        $statusStaff = $this->staffRepo->getStatusStaff($id);
        $anotherStatus = $this->staffRepo->getStatusStaffExceptStatus($staff->status);
        return view('Admin.dist.creative.staff.edit', [
            'title' => 'Trang Quản Lý Nhân Viên'
        ], compact('staff', 'statusStaff', 'anotherStatus'));
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
        $data['password'] = Hash::make($request->password);
        $staff = $this->staffRepo->update($id, $data);
        return redirect()->route('staff.index');
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
        $staff = $this->staffRepo->delete($id);
        return redirect()->route('staff.index');
    }

    public function account(){
        $staff = auth()->user();
        return view('Admin.dist.creative.account.index', [
            'title' => 'Trang Quản Lý Nhân Viên'
        ], compact('staff'));
    }

    public function updateAccount(Request $request){
        $data = $request->all();
        $staff = auth()->user();
        if($request->has('password')){
            if(Hash::check($data['old_password'], $staff->password)){
                $data['password'] = Hash::make($request->password);
            }else{
                Session::flash('error','Mật khấu không chính xác');
                return redirect()->back();
            }
        }
        $staff = $this->staffRepo->update($staff->id, $data);
        return redirect()->route('admin.account');

    }
}
