<?php

namespace Devio\Page;

use Devio\Page\Contracts\ActionResolver as ActionResolverInterface;

class ActionResolver implements ActionResolverInterface
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

        return config('page.namespace') . "\\$controller@index";
    }
}