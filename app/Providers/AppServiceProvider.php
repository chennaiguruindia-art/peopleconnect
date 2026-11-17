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
        // Auto-create cache and storage directories if missing on Windows IIS/Plesk
        try {
            $requiredDirs = [
                storage_path('framework/cache/data'),
                public_path('storage'),
                public_path('storage/attachments'),
                public_path('storage/attachments/photos'),
                public_path('storage/attachments/documents'),
                public_path('storage/attachments/resolutions'),
                public_path('storage/attachments/evidence'),
            ];
            foreach ($requiredDirs as $dir) {
                if (!is_dir($dir)) {
                    @mkdir($dir, 0777, true);
                }
            }
        } catch (\Throwable $e) {
            // Ignore
        }

        Blade::directive('aitrans', function ($expression) {
            return "<?php echo app(\\App\\Services\\GeminiTranslationService::class)->translate({$expression}, app()->getLocale()); ?>";
        });
    }
}
