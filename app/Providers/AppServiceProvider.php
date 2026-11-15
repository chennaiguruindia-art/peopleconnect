<?php

namespace App\Providers;

use App\Services\GeminiTranslationService;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(GeminiTranslationService::class, function () {
            return new GeminiTranslationService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Auto-create cache/data directory if missing on Windows IIS/Plesk
        try {
            $dataDir = storage_path('framework/cache/data');
            if (!is_dir($dataDir)) {
                @mkdir($dataDir, 0777, true);
            }
        } catch (\Throwable $e) {
            // Ignore
        }

        Blade::directive('aitrans', function ($expression) {
            return "<?php echo app(\\App\\Services\\GeminiTranslationService::class)->translate({$expression}, app()->getLocale()); ?>";
        });
    }
}
