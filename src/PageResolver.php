<?php

namespace Devio\Page;

use Devio\Page\Contracts\PageResolver as PageResolverInterface;
use Devio\Page\Contracts\stringtring;

class PageResolver implements PageResolverInterface
{
    /**
     * Resolve a page action path.
     *
     * @param Page $page
     * @return string
     */
    public function resolve(Page $page): string
    {
        $controller = str_replace('.', '\\', ucfirst($page->route)) . 'Controller';

        return config('seo.namespace') . "\\$controller@index";
    }
}