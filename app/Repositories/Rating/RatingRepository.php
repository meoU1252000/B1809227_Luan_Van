<?php

namespace App\Repositories\Rating;
use App\Repositories\BaseRepository;

class RatingRepository extends BaseRepository implements RatingRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\ProductRating::class;
    }
}
