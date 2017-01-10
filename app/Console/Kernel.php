<?php

namespace App\Console;

use App\Components\GitHub\FetchGitHubFileContent;
use App\Components\GoogleCalendar\FetchCompanyGoogleCalendarEvents;
use App\Components\GoogleCalendar\FetchVacationGoogleCalendarEvents;
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
        \App\Components\LastFm\FetchCurrentTrack::class,
        \App\Components\Packagist\FetchTotals::class,
        \App\Components\InternetConnectionStatus\SendHeartbeat::class,
        \App\Components\RainForecast\FetchRainForecast::class,
        FetchCurrentConditions::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     */
    protected function schedule(Schedule $schedule)
    {
        //$schedule->command(\App\Components\LastFm\FetchCurrentTrack::class)->everyMinute();
        $schedule->command(FetchVacationGoogleCalendarEvents::class)->everyFiveMinutes();
        $schedule->command(FetchCompanyGoogleCalendarEvents::class)->everyFiveMinutes();
        $schedule->command(\App\Components\GitHub\FetchGitHubFileContent::class)->everyFiveMinutes();
        $schedule->command(\App\Components\InternetConnectionStatus\SendHeartbeat::class)->everyMinute();
        //$schedule->command(\App\Components\Packagist\FetchTotals::class)->hourly();
        $schedule->command(\App\Components\RainForecast\FetchRainForecast::class)->everyMinute();
        $schedule->command(FetchCurrentConditions::class)->everyMinute()->timezone('America/New_York')
            ->between('7:00', '20:00'); //Limited to: 500 Calls Per Day.
    }
}
