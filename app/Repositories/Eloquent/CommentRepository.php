<?php

namespace App\Repositories\Eloquent;

use App\Models\Comment;
use App\Repositories\Interfaces\CommentRepositoryInterface;



class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
    public function __construct(Comment $model)
    {
        parent::__construct($model);
    }
}
