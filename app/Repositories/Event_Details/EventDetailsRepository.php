<?php

namespace App\Repositories\Event_Details;
use App\Repositories\BaseRepository;
use App\Models\Event;

class EventDetailsRepository extends BaseRepository implements EventDetailsRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\EventDetails::class;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getEvent($id){
        return Event::find($id);
    }

}
