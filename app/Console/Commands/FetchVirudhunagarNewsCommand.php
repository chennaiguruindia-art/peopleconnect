<?php

namespace App\Console\Commands;

use App\Services\VirudhunagarNewsService;
use Illuminate\Console\Command;

class FetchVirudhunagarNewsCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'news:fetch-virudhunagar {--force : Force fetch even if recently cached}';

    /**
     * The console command description.
     */
    protected $description = 'Fetch live Virudhunagar district news from Google News RSS feed';

    /**
     * Execute the console command.
     */
    public function handle(VirudhunagarNewsService $newsService): int
    {
        $force = (bool) $this->option('force');
        $this->info('Fetching live news updates for Virudhunagar District...');

        $count = $newsService->syncLatestNews($force);

        $this->info("Successfully synced {$count} new Virudhunagar news articles.");

        return Command::SUCCESS;
    }
}
