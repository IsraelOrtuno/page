<?php

namespace Devio\Pages\Traits;

use Devio\Pages\Page;
use Devio\Pages\PageManager;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasPages
{ 
    public static function bootHasPages()
    {
        // Binding the route to the page resolutionZZ
        /*\Route::bind((new static)->getParameterName(), function ($value) {
            if ($page = Page::where('slug', $value)->first()) {
                return $page->browseable;
            }
            abort(404);
        });*/
    }

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
    public function createPage($attributes = null): self
    {
        return app(PageManager::class)->model($this)->handle($attributes);
    }

    /**
     * Update the current entity page.
     *
     * @param null $attributes
     * @return mixed
     */
    public function updatePage($attributes = null): self
    {
        return $this->createSeo($attributes);
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