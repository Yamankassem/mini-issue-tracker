<?php

namespace App\Repositories\Eloquent;

use App\Models\Label;
use App\Repositories\Interfaces\LabelRepositoryInterface;





class LabelRepository extends BaseRepository implements LabelRepositoryInterface
{
    public function __construct(Label $model)
    {
        parent::__construct($model);
    }
}