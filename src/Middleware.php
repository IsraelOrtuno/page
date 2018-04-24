<?php

namespace Devio\Page;

use Devio\Page\Generators\MetaGenerator;

class Middleware
{
    /**
     * @var PageManager
     */
    protected $manager;

    /**
     * Middleware constructor.
     */
    public function __construct(PageManager $manager)
    {
        $this->manager = $manager;
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        $page = Page::where('slug', $this->getRoutePath());

        // If any page with the given route path (slug) is found, we will run
        // the existing generators for the current page.
        // TODO: This query is executed every request, consider caching
        if ($current = $page->first()) {
            $this->manager->generateAll($current);
        }

        $this->dispatch($request);

        return $next($request);
    }

    protected function dispatch($request, $route = null)
    {
        $route = $route ?: $request->route()->getName();

        event("page:route:{$route}", $request->route()->parameters());
    }

    protected function getRoutePath()
    {
        return ltrim(request()->path(), '/');
    }
}