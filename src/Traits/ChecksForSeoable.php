<?php

namespace Devio\Page\Traits;

use Devio\Page\Traits\Seoable;

trait ChecksForSeoable
{
    /**
     * Check if the given model uses the Seoable Trait.
     *
     * @return bool
     */
    protected function usesSeoable($model)
    {
        return in_array(Seoable::class, class_uses_recursive(
            get_class($model)
        ));
    }
}