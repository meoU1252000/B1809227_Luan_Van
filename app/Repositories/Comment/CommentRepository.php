<?php

namespace App\Repositories\Comment;
use App\Repositories\BaseRepository;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\ProductComment::class;
    }
}
