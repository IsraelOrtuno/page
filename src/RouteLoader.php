<?php

namespace Devio\Page;

use Devio\Page\Contracts\ActionResolver;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Routing\Router;

class RouteLoader
{
    /**
     * The application instance.
     *
     * @var Application
     */
    protected $app;

    /**
     * The router instance.
     *
     * @var Router
     */
    protected $router;

    /**
     * The action resolver instance.
     *
     * @var ActionResolver
     */
    protected $actionResolver;

    /**
     * Router constructor.
     *
     * @param Application $app
     * @param Router $router
     * @param Contracts\ActionResolver $actionResolver
     */
    public function __construct(Application $app, Router $router, ActionResolver $actionResolver)
    {
        $this->app = $app;
        $this->router = $router;
        $this->actionResolver = $actionResolver;
    }

    /**
     * Load the given set of routes.
     *
     * @param $pages
     */
    public function load()
    {
        $this->getPages()->each(function ($page) {
            $action = $page->browseable ? $page->browseable->getAction()
                : $this->actionResolver->resolve($page);

            $route = $this->router->get($page->slug, $action)->name($page->route)->middleware('web');

            if ($page->browseable) {
                $route->defaults($page->browseable->getParameterName(), $page->browseable);
            }
        });
    }

    protected function getPages()
    {
        try {
            if (! $this->app->routesAreCached() && \Schema::hasTable('pages')) {
                return Page::all();
            }

        } catch (\Exception $e) {
        }

        return collect();
    }
}