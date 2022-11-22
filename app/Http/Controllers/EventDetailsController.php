<?php

namespace App\Http\Controllers;

use App\Models\EventDetails;
use Illuminate\Http\Request;
use App\Repositories\Event_Details\EventDetailsRepositoryInterface;
class EventDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(EventDetailsRepositoryInterface $eventRepo)
    {
        $this->eventRepo = $eventRepo;
    }
    public function index($id)
    {
        //
        $event = $this->eventRepo->getEvent($id);
        return view('Admin.dist.creative.event.event_details.index',[
            'title'=>'Trang Quản Lý Sự Kiện'
        ],compact('event'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $event = $this->eventRepo->getEvent($id);

        return view('Admin.dist.creative.event.event_details.add',[
            'title'=>'Trang Quản Lý Sự Kiện'
        ],compact('event'));
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
     * @param  \App\Models\EventDetails  $eventDetails
     * @return \Illuminate\Http\Response
     */
    public function show(EventDetails $eventDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EventDetails  $eventDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(EventDetails $eventDetails)
    {
        //
        $event = $this->eventRepo->find($id);
        return view('Admin.dist.creative.event.event_details.edit',[
            'title'=>'Trang Quản Lý Sự Kiện'
        ],compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EventDetails  $eventDetails
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        //
        $data = $request->all();
        $event = $this->eventRepo->update($id,$data);

        return redirect()->route('event.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EventDetails  $eventDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventDetails $eventDetails)
    {
        //
        $event = $this->eventRepo->delete($id);
        return redirect()->route('event.index');
    }
}
