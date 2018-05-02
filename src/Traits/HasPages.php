<?php

namespace Devio\Page\Traits;

use Devio\Page\Page;
use Devio\Page\Store;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasPages
{
    /**
     * Get the slug from parent.
     *
     * @return string
     */
//    public abstract function getSlug(): string;

    /**
     * Get the controller action.
     *
     * @return string
     */
    abstract public function getAction(): string;

    /**
     * Get the page parameter name.
     *
     * @return string
     */
    public function getParameterName(): string
    {
        return kebab_case((new \ReflectionClass($this))->getShortName()) . '_seo';
    }

    /**
     * The page polymorphic relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function page(): MorphOne
    {
        return $this->morphOne(Page::class, 'browseable');
    }

    /**
     * Create a new page for the current entity.
     *
     * @param null $attributes
     * @return mixed
     */
    public function createPage($attributes = null)
    {
        return app(Store::class)->model($this)->handle($attributes);
    }

    /**
     * Update the current entity page.
     *
     * @param null $attributes
     * @return mixed
     */
    public function updatePage($attributes = null)
    {
        return $this->createPage($attributes);
    }

    /**
     * Delete the page for the current entity.
     *
     * @return mixed
     */
    public function deletePage(): int
    {
        return $this->page->delete();
    }

    /**
     * Check if the the current entity has a page relationship.
     *
     * @return bool
     */
    public function hasPage(): bool
    {
        return (bool) ! is_null($this->page);
    }
}