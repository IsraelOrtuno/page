<?php

namespace Devio\Page\Composers;

use Devio\Page\Seo;
use Illuminate\Contracts\View\View;
use Devio\Page\Traits\ChecksForSeoable;

class VariablesComposer
{
    use ChecksForSeoable;

    public function compose(View $view)
    {
        $seoEntity = $view['__seoEntity'] ?? null;

        if (is_null($seoEntity)) {
            $view->with('__seoEntity', $this->getPrimaryEntity($view->getData()));
        }

        $view->with('__seo', $view['__seoEntity']->seo ?? new Seo);
    }

    public function getPrimaryEntity($data = [])
    {
        foreach ($data as $variable) {
            if (is_object($variable) && $this->usesSeoable($variable)) {
                return $variable;
            }
        }

        return null;
    }
}