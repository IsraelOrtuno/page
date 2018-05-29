<?php

namespace Devio\Page;

use Devio\Page\Contracts\ActionResolver as ActionResolverInterface;

class ActionResolver implements ActionResolverInterface
{
    /**
     * Resolve a page action path.
     *
     * @param Page $page
     */
    public function resolve(Page $page)
    {
        $controller = config('page.namespace') . '\\' . str_replace('.', '\\', ucfirst($page->route)) . 'Controller';

        return class_exists($controller)
            ? "$controller@index" : function() {
                return 'View controller not found';
            };
    }
}