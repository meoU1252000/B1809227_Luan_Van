<?php

namespace App\Repositories\Event_Details;
use App\Repositories\RepositoryInterface;

interface EventDetailsRepositoryInterface extends RepositoryInterface
{
    public function getEvent($id);
}
