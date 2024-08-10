<?php

namespace App\Console\Commands;

use App\Jobs\FetchAdwordsData;
use App\Jobs\FetchAnalyticsData;
use App\Services\GoogleAds\GoogleAdsService;
use App\Services\GoogleAdsServic;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Spatie\Analytics\AnalyticsClient;

class FetchAdwordsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'adwords:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch analytics data';

    /**
     * Execute the console command.
     */
    public function handle(GoogleAdsService $googleAdsService)
    {
        Log::info('Fetching analytics data started.');
        //dispatch(new FetchAnalyticsData($analyticsClient));
        (new FetchAdwordsData())->handle($googleAdsService);
        Log::info('Fetching analytics data ended.');
    }
}
