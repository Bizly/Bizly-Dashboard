<?php

namespace App\Events\Weather;

use App\Events\DashboardEvent;

class CurrentConditionsFetched extends DashboardEvent
{
    /** @var array */
    public $conditions;

    public function __construct($conditions)
    {
        $this->conditions = $conditions;
    }
}
