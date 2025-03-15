<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\ParentCategory;
use Illuminate\Support\ServiceProvider;

class CommonDataServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('commonData', function ($app) {
            return [
                'parentCategoriesMega' => ParentCategory::with('categories')->whereHas('categories')->whereNotNull('rank')->orderBy('rank', 'asc')->get(),
                'parentCategoriesNormal'=>ParentCategory::with('categories')->whereHas('categories')->whereNull('rank')->get(),        
                'categories' => Category::all(),
            ];
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
