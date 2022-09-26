<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //

        $this->app->singleton(
            \App\Repositories\CategoryAttribute\CategoryAttributeRepositoryInterface::class,
            \App\Repositories\CategoryAttribute\CategoryAttributeRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Auth\AuthRepositoryInterface::class,
            \App\Repositories\Auth\AuthRepository::class
        );

        $this->app->singleton(
            \App\Repositories\ProductFamily\ProductFamilyRepositoryInterface::class,
            \App\Repositories\ProductFamily\ProductFamilyRepository::class
        );

        $this->app->singleton(
            \App\Repositories\ImportDetails\ImportDetailsRepositoryInterface::class,
            \App\Repositories\ImportDetails\ImportDetailsRepository::class
        );

        $this->app->singleton(
            \App\Repositories\ProductPrice\ProductPriceRepositoryInterface::class,
            \App\Repositories\ProductPrice\ProductPriceRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Import\ImportRepositoryInterface::class,
            \App\Repositories\Import\ImportRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Supplier\SupplierRepositoryInterface::class,
            \App\Repositories\Supplier\SupplierRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Event\EventRepositoryInterface::class,
            \App\Repositories\Event\EventRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Staff\StaffRepositoryInterface::class,
            \App\Repositories\Staff\StaffRepository::class
        );

        $this->app->singleton(
            \App\Repositories\RepositoryInterface::class,
            \App\Repositories\BaseRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Category\CategoryRepositoryInterface::class,
            \App\Repositories\Category\CategoryRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Product\ProductRepositoryInterface::class,
            \App\Repositories\Product\ProductRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Brand\BrandRepositoryInterface::class,
            \App\Repositories\Brand\BrandRepository::class
        );

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
