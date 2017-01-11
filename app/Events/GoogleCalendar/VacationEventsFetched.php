<?php
/**
 * Class VacatinEventsFetched
 *
 * @package    namespace App\Events\GoogleCalendar;
 * @version    1.0.0
 * @author     Tor Miller
 * @copyright  (c) 2015-2017, Bizly.co
 */

namespace App\Events\GoogleCalendar;

use App\Events\DashboardEvent;

class VacationEventsFetched extends DashboardEvent
{
    /** @var array */
    public $events;

    public function __construct(array $events)
    {
        $this->events = $events;
    }
}
