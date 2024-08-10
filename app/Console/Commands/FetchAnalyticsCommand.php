<?php

namespace App\Console\Commands;

use App\Jobs\FetchAnalyticsData;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Spatie\Analytics\AnalyticsClient;

class FetchAnalyticsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'analytics:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch analytics data';

    /**
     * Execute the console command.
     */
    public function handle(AnalyticsClient $analyticsClient)
    {
        Log::info('Fetching analytics data started.');
        //dispatch(new FetchAnalyticsData($analyticsClient));
        (new FetchAnalyticsData($analyticsClient))->handle();
        Log::info('Fetching analytics data ended.');
    }
}
