<?php

namespace Devio\Seo\Composers;

use Devio\Seo\Seoable;
use Illuminate\Contracts\View\View;

class FormComposer
{
    public function compose(View $view)
    {
        $route = request()->route();

        if (! ($controller = $route->getController()) instanceof Seoable) {
            return;
        }

        $view['seo'] = array_merge($route->parameters(), $view['seo'] ?? []);


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
}