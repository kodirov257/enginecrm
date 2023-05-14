<?php

namespace App\Services;

use App\Entity\Station;
use App\Events\StationColumnsUpdated;

class StationService
{
    public function checkStatus(int $id): Station
    {
        $station = Station::findOrFail($id);

        $stationName = 'station_' . $station->station;
        if (\Session::has($stationName)) {
            $sessionStation = \Session::get($stationName);
            if (
                $station->alert !== $sessionStation->alert
                || $station->lat !== $sessionStation->lat
                || $station->long !== $sessionStation->long
            ) {
                $this->updateSession($stationName, $station);

                event(new StationColumnsUpdated($station));
            }
        } else {
            $this->updateSession($stationName, $station);
        }

        return $station;
    }

    private function updateSession(string $stationName, Station $station): void
    {
        \Session::put($stationName, $station->only(['station', 'alert', 'lat', 'long']));
    }
}
