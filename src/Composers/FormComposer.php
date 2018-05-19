<?php

namespace Devio\Page\Composers;

use Devio\Page\Seoable;
use Devio\Page\Traits\HasPages;
use Illuminate\Contracts\View\View;

class FormComposer
{
    public function compose(View $view)
    {
        $route = request()->route();

        $entity = $this->getPrimaryEntity($view);

        $view->with([
            'page' => $entity->page ?? [],
            'pageData' => array_merge($route->parameters(), $view['pageData'] ?? [])
        ]);

//        // We will check if the current controller action is supposed to have
//        // automatic SEO keys injection. If so we'll add the current route
//        // parameters to any existing (or not) SEO key data to the view.
//        if (($resources = $controller->seoResources()) == '*' ||
//            in_array($route->getActionMethod(), (array) $resources)) {
//            $view['seo'] = array_merge(
//                $route->parameters(), $view['seo'] ?? []
//            );
//        }
    }

    public function getPrimaryEntity($view)
    {
        foreach ($view->getData() as $variable) {
            if (is_object($variable) && class_uses_recursive(HasPages::class)) {
                return $variable;
            }
        }

        return null;
    }
}