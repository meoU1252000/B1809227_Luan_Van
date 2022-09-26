<?php

namespace App\Repositories\Event;
use App\Repositories\BaseRepository;

class EventRepository extends BaseRepository implements EventRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Event::class;
    }

    public function getAll()
    {
        return $this->model->all();
    }

}
