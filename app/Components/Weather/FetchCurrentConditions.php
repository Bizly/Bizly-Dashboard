<?php

namespace App\Components\Weather;

use App\Events\Weather\CurrentConditionsFetched;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class FetchCurrentConditions extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'dashboard:weather-current';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch the Current Weather Conditions.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $weatherUndergroundAPIKey = env('WEATHER_UNDERGROUND_API_KEY');
        $weatherUndergroundCityState = env('WEATHER_UNDERGROUND_CITY_STATE');
        $responseBody = (string) (new Client())
            ->get('http://api.wunderground.com/api/' . $weatherUndergroundAPIKey . '/conditions/q/' . $weatherUndergroundCityState . '.json')
            ->getBody();

        $conditions = json_decode($responseBody);
        event(new CurrentConditionsFetched($conditions));
    }

}
