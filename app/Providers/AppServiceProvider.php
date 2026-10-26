<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use App\Models\Category;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        Blade::directive('price_format', function ($price) {
            return "<?php echo number_format($price, 0, ',', ' '); ?>";
        });
        
        View()->composer('layouts.navbar', function ($view) {
            $view->with('categories', Category::all());
        });
    }
}
