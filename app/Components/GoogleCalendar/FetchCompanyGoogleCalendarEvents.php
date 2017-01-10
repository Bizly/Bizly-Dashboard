<?php

namespace App\Components\GoogleCalendar;

use App\Events\GoogleCalendar\CompanyEventsFetched;
use Carbon\Carbon;
use DateTime;
use Illuminate\Console\Command;
use Spatie\GoogleCalendar\Event;

class FetchCompanyGoogleCalendarEvents extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'dashboard:company-calendar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Google Company Calendar events.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $calendarId = config('laravel-google-calendar.company_calendar_id');
        $events = collect(Event::get(null, null, [], $calendarId))
            ->filter(function (Event $event) {
                return true;
            })->map(function (Event $event) {
            return [
                'name' => $event->name,
                'date' => Carbon::createFromFormat('Y-m-d H:i:s', $event->getSortDate())->format(DateTime::ATOM),
                'description' => $event->description,
                'created_by' => $event->creator,
            ];
        })
            //->unique('name')
            ->toArray();

        event(new CompanyEventsFetched($events));
    }
}
