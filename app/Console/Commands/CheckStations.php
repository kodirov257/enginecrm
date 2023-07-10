<?php

namespace App\Console\Commands;

use App\Entity\Station;
use App\Services\StationService;
use Illuminate\Console\Command;

class CheckStations extends Command
{
    protected $signature = 'station:check-all';

    protected $description = 'Check all stations';
    private StationService $service;

    public function __construct(StationService $service)
    {
        $this->service = $service;

        parent::__construct();
    }

    public function handle(): void
    {
        try {
            $this->service->checkStations();
        } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
        }
    }
}
