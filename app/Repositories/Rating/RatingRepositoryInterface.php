<?php

namespace App\Repositories\Rating;
use App\Repositories\RepositoryInterface;
interface RatingRepositoryInterface extends RepositoryInterface
{
    public function getAll();
}
