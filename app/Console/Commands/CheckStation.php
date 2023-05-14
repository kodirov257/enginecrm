<?php

namespace App\Console\Commands;

use App\Entity\Station;
use App\Services\StationService;
use Illuminate\Console\Command;

class CheckStation extends Command
{
    protected $signature = 'station:check';
    protected $description = 'Check status of station';
    private StationService $service;

    public function __construct(StationService $service)
    {
        $this->service = $service;

        parent::__construct();
    }

    public function handle(): void
    {
        try {
            $stations = Station::get();
            foreach ($stations as $station) {
                $this->service->checkStatus($station->station);
            }
        } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
        }
    }
}
