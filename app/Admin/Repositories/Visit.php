<?php

namespace App\Admin\Repositories;

use App\Models\Visit as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Visit extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
