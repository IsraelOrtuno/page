<?php

namespace Devio\Page;

use Devio\Page\Contracts\ActionResolver;
use Illuminate\Routing\Router;

class RouteLoader
{
    /**
     * The router instance.
     *
     * @var Router
     */
    protected $router;

    /**
     * Router constructor.
     *
     * @param Router $router
     * @param Contracts\ActionResolver $actionResolver
     */
    public function __construct(Router $router, ActionResolver $actionResolver)
    {
        $this->router = $router;
        $this->actionResolver = $actionResolver;
    }

    /**
     * Load the given set of routes.
     *
     * @param $pages
     */
    public function load($pages)
    {
        $pages->each(function ($page) {
            $action = $page->browseable ? $page->browseable->getAction()
                : $this->actionResolver->resolve($page);

            $route = $this->router->get($page->slug, $action)->name($page->route)->middleware('web');

            if ($page->browseable) {
                $route->defaults($page->browseable->getParameterName(), $page->browseable);
            }
        });
    }
}