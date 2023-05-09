<?php

namespace App\Repositories;

use App\Models\Gift;
use App\Repositories\BaseRepository;

class GiftRepository extends BaseRepository
{

    public function __construct(Gift $model)
    {
        parent::__construct($model);
    }
   
}
