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
        Blade::directive('aitrans', function ($expression) {
            return "<?php echo app(\\App\\Services\\GeminiTranslationService::class)->translate({$expression}, app()->getLocale()); ?>";
        });
    }
}
