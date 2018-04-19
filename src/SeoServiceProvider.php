<?php

namespace Devio\Seo;

use Devio\Seo\Composers\TagComposer;
use Devio\Seo\Composers\FormComposer;
use Devio\Seo\Contracts\PageResolver;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Devio\Seo\Composers\VariablesComposer;
use Devio\Seo\Transformers\MetaTransformer;

class SeoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->defineResources();
        $this->defineRoutes();

        $this->defineComposers();
    }

    protected function defineRoutes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        $router = $this->app['router'];

        Page::all()->each(function ($page) use ($router) {
            $action = $page->browseable ? $page->browseable->getAction()
                : $this->app->make(PageResolver::class)->resolve($page);

            $route = $router->get($page->slug, $action)->name($page->route)->middleware('web');

            if ($page->browseable) {
             //   $route->defaults($page->browseable->getParameterName(), $page->slug);
                $route->defaults($page->browseable->getParameterName(), $page->browseable);
            }
        });
    }

    public function defineComposers(): void
    {
//        \View::composer('*', TagComposer::class);
//        \View::composer('seo::form', FormComposer::class);
//        \View::composer('welcome', VariablesComposer::class);
    }

    /**
     * Define the resources for the package.
     */
    protected function defineResources(): void
    {
        $this->loadViewsFrom(realpath(__DIR__ . '/../') . '/resources/views', 'seo');

        $this->mergeConfigFrom(__DIR__ . '/../config/seo.php', 'seo');

        $this->loadMigrationsFrom(__DIR__ . '/../migrations/');
    }

    public function register()
    {
        // Always set the container for the Manager class
        $this->app->resolving(PageManager::class, function ($manager, $app) {
            $manager->setContainer($app);
        });

        $this->registerSingletonServices();

        $this->app->bind('seo.transformers.meta', MetaTransformer::class);
        $this->app->bind('seo.transformers.opengraph', MetaTransformer::class);
        $this->app->bind('seo.transformers.twitter', MetaTransformer::class);
    }

    protected function registerSingletonServices(): void
    {
        $services = [
            PageResolver::class => \Devio\Seo\PageResolver::class
        ];

        foreach ($services as $key => $value) {
            $this->app->singleton($key, $value);
        }
    }
}