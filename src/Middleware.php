<?php

namespace Devio\Page;

use Devio\Page\Generators\MetaGenerator;

class Middleware
{
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
            $this->runGenerators($current);
        }

        return $next($request);
    }

    protected function runGenerators($page)
    {
        app(MetaGenerator::class)->handle($page->meta);
    }

    protected function getRoutePath()
    {
        return ltrim(request()->path(), '/');
    }
}