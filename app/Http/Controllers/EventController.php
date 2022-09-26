<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Event\EventRepositoryInterface;

class EventController extends Controller
{
    protected $eventRepo;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
     * PostController constructor.
     *
     * @param EventRepositoryInterface $post
     */

    public function __construct(EventRepositoryInterface $eventRepo)
    {
        $this->eventRepo = $eventRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = $this->eventRepo->getAll();

        return view('Admin.dist.creative.event.index',[
            'title'=>'Trang Quản Lý Sự Kiện'
        ],compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Admin.dist.creative.event.add',[
            'title'=>'Trang Quản Lý Sự Kiện'
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

        $event = $this->eventRepo->create($data);

        return redirect()->route('event.index');
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
        $event = $this->eventRepo->find($id);
        return view('Admin.dist.creative.event.edit',[
            'title'=>'Trang Quản Lý Sự Kiện'
        ],compact('event'));
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
        $event = $this->eventRepo->update($id,$data);

        return redirect()->route('event.index');
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
        $event = $this->eventRepo->delete($id);
        return redirect()->route('event.index');
    }
}
