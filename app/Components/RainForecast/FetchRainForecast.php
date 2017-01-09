<?php

namespace App\Components\RainForecast;

use App\Events\RainForecast\ForecastFetched;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class FetchRainForecast extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'dashboard:rain';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch the rain forecast.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $lat = 40.7128;
        $lng = 74.0059;

        $openWeatherMapAPIKey = env('OPEN_WEATHER_MAP_API_KEY');
        $zipCode = env('WEATHER_ZIP_CODE');
        $responseBody = (string) (new Client())
            ->get("http://api.openweathermap.org/data/2.5/weather?zip=" . $zipCode . ",us&appid=" . $openWeatherMapAPIKey)
            ->getBody();

        $forecast = $this->getForecastFromResponseBody($responseBody);
        event(new ForecastFetched($forecast));
    }

    public function getForecastFromResponseBody(string $responseBody): array
    {

        return (array) json_decode($responseBody);
    }

    public function getCarbonFromTime(string $time): Carbon
    {
        $dateTime = Carbon::createFromFormat('H:i', $time);

        if (starts_with($time, '00') && Carbon::now()->hour == 23) {
            $dateTime->addDay();
        }

        return $dateTime;
    }
}
