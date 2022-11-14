<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Contracts\Routing\UrlGenerator;
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
        if(env('REDIRECT_HTTPS')) {
            $this->app['request']->server->set('HTTPS', true);
        }

        $this->app->singleton(
            \App\Repositories\CategoryAttribute\CategoryAttributeRepositoryInterface::class,
            \App\Repositories\CategoryAttribute\CategoryAttributeRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Customer\CustomerRepositoryInterface::class,
            \App\Repositories\Customer\CustomerRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Order\OrderRepositoryInterface::class,
            \App\Repositories\Order\OrderRepository::class
        );

        $this->app->singleton(
            \App\Repositories\OrderDetails\OrderDetailsRepositoryInterface::class,
            \App\Repositories\OrderDetails\OrderDetailsRepository::class
        );


        $this->app->singleton(
            \App\Repositories\Address\AddressRepositoryInterface::class,
            \App\Repositories\Address\AddressRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Image\ImageRepositoryInterface::class,
            \App\Repositories\Image\ImageRepository::class
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
            \App\Repositories\Rating\RatingRepositoryInterface::class,
            \App\Repositories\Rating\RatingRepository::class
        );

         $this->app->singleton(
            \App\Repositories\Comment\CommentRepositoryInterface::class,
            \App\Repositories\Comment\CommentRepository::class
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
    public function boot(UrlGenerator $url)
    {
        //
        Schema::defaultStringLength(191);
        if(env('REDIRECT_HTTPS')) {
            $url->formatScheme('https');
        }
    }
}
