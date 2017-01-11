<?php
/**
 * Class CurrentConditionsFetched
 *
 * @package    namespace App\Events\Weather;
 * @version    1.0.0
 * @author     Tor Miller
 * @copyright  (c) 2015-2017, Bizly.co
 */

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
