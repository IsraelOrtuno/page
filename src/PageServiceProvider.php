<?php

namespace Devio\Page;

use Devio\Page\Composers\TagComposer;
use Devio\Page\Composers\FormComposer;
use Devio\Page\Contracts\ActionResolver;
use Devio\Page\Generators\MetaGenerator;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Devio\Page\Composers\VariablesComposer;
use Devio\Page\Transformers\MetaTransformer;

class PageServiceProvider extends ServiceProvider
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
        if ($this->app->routesAreCached() || ! \Schema::hasTable('pages')) {
            return;
        }

        $router = $this->app['router'];

        Page::all()->each(function ($page) use ($router) {
            $action = $page->browseable ? $page->browseable->getAction()
                : $this->app->make(ActionResolver::class)->resolve($page);

            $route = $router->get($page->slug, $action)->name($page->route)->middleware('web');

            if ($page->browseable) {
                $route->defaults($page->browseable->getParameterName(), $page->browseable);
            }
        });
    }

    public
    function defineComposers(): void
    {
//        \View::composer('*', TagComposer::class);
//        \View::composer('seo::form', FormComposer::class);
//        \View::composer('welcome', VariablesComposer::class);
    }

    /**
     * Define the resources for the package.
     */
    protected
    function defineResources(): void
    {
        $path = realpath(__DIR__ . '/../');

        $this->loadViewsFrom("{$path}/resources/views", 'page');

        $this->mergeConfigFrom("{$path}/config/page.php", 'page');

        $this->loadMigrationsFrom("{$path}/migrations/");
    }

    public
    function register()
    {
        // Always set the container for the Manager and Store classes
        $this->app->resolving(Store::class, function ($store, $app) {
            $store->setContainer($app);
        });
        $this->app->resolving(PageManager::class, function ($manager, $app) {
            $manager->setContainer($app);
        });

        $this->registerSingletonServices();

        $this->app->bind('seo.transformers.meta', MetaTransformer::class);
//        $this->app->bind('seo.transformers.opengraph', MetaTransformer::class);
//        $this->app->bind('seo.transformers.twitter', MetaTransformer::class);

        // Generators
        $this->app->bind('page.generator.meta', MetaGenerator::class);
//        $this->app->bind('page.generator.opengraph', MetaTransformer::class);
//        $this->app->bind('page.generator.twitter', MetaTransformer::class);
    }

    protected
    function registerSingletonServices(): void
    {
        $services = [
            ActionResolver::class => \Devio\Page\ActionResolver::class
        ];

        foreach ($services as $key => $value) {
            $this->app->singleton($key, $value);
        }
    }
}