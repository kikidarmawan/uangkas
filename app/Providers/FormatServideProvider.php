<?php

namespace App\Providers;

use App\Helpers\Currency;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class FormatServideProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        require_once app_path() . '/Helpers/Currency.php';
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Blade::directive('currencyRupiah', function ($expression) {
            return "<?php echo app('" . Currency::class . "')->rupiah($expression); ?>";
        });
    }
}
