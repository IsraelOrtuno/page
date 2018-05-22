<?php

namespace Devio\Page;

//use Devio\Page\Composers\TagComposer;
use Devio\Page\Composers\FormComposer;
use Illuminate\Support\ServiceProvider;
use Devio\Page\Contracts\ActionResolver;
use Devio\Page\Generators\MetaGenerator;
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
        // This try/catch block is used to make sure that the database connection
        // really exists, otherwise there will be problems as soon as the file
        // is loaded into the Laravel bootstrap stack.
        try {
            if ($this->app->routesAreCached() || ! \Schema::hasTable('pages')) {
                return;
            }

            $this->app->make(RouteLoader::class)->load(Page::all());
        } catch (\Exception $e) {
        }
    }

    public function defineComposers(): void
    {
//        \View::composer('*', TagComposer::class);
        \View::composer('page::form', FormComposer::class);
//        \View::composer('welcome', VariablesComposer::class);
    }

    /**
     * Define the resources for the package.
     */
    protected function defineResources(): void
    {
        $path = realpath(__DIR__ . '/../');

        $this->loadViewsFrom("{$path}/resources/views", 'page');

        $this->mergeConfigFrom("{$path}/config/page.php", 'page');

        if (env('APP_ENV') !== 'testing') {
            $this->loadMigrationsFrom("{$path}/migrations/");
        }

        $this->publishes([
            __DIR__ . '/../migrations' => database_path('migrations'),
        ], 'page');
    }

    public function register()
    {
        // Always set the container for the Manager and Store classes
        $this->app->resolving(Store::class, function ($store, $app) {
            $store->setContainer($app);
        });
        $this->app->resolving(PageManager::class, function ($manager, $app) {
            $manager->setContainer($app);
        });

        $this->registerSingletonServices();

        $this->app->bind('page.transformers.meta', MetaTransformer::class);
//        $this->app->bind('seo.transformers.opengraph', MetaTransformer::class);
//        $this->app->bind('seo.transformers.twitter', MetaTransformer::class);

        // Generators
        $this->app->bind('page.generator.meta', MetaGenerator::class);
//        $this->app->bind('page.generator.opengraph', MetaTransformer::class);
//        $this->app->bind('page.generator.twitter', MetaTransformer::class);
    }

    protected function registerSingletonServices(): void
    {
        $services = [
            ActionResolver::class => \Devio\Page\ActionResolver::class
        ];

        foreach ($services as $key => $value) {
            $this->app->singleton($key, $value);
        }

        $this->app->singleton(RouteLoader::class, function ($app) {
            return new RouteLoader($app['router'], $app[ActionResolver::class]);
        });
    }
}