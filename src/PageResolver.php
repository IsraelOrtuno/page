<?php

namespace Devio\Pages;

use Devio\Pages\Contracts\PageResolver as PageResolverInterface;
use Devio\Pages\Contracts\stringtring;

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