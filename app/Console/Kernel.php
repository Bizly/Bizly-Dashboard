<?php

namespace App\Console;

use App\Components\GitHub\FetchGitHubFileContent;
use App\Components\GoogleCalendar\FetchCompanyGoogleCalendarEvents;
use App\Components\GoogleCalendar\FetchVacationGoogleCalendarEvents;
use App\Components\InternetConnectionStatus\SendHeartbeat;
use App\Components\Refresh\SendRefreshSignal;
use App\Components\Weather\FetchCurrentConditions;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        FetchGitHubFileContent::class,
        FetchVacationGoogleCalendarEvents::class,
        FetchCompanyGoogleCalendarEvents::class,
        SendHeartbeat::class,
        FetchCurrentConditions::class,
        SendRefreshSignal::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command(FetchVacationGoogleCalendarEvents::class)->everyFiveMinutes();
        $schedule->command(FetchCompanyGoogleCalendarEvents::class)->everyFiveMinutes();
        $schedule->command(\App\Components\GitHub\FetchGitHubFileContent::class)->everyFiveMinutes();
        $schedule->command(\App\Components\InternetConnectionStatus\SendHeartbeat::class)->everyMinute();
        $schedule->command(FetchCurrentConditions::class)->everyMinute()->timezone('America/New_York')
            ->between('7:00', '20:00'); //Limited to: 500 Calls Per Day.
    }
}
