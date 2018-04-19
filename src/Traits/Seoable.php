<?php

namespace Devio\Pages\Traits;

use Devio\Pages\Seo;
use Devio\Pages\Meta;
use Devio\Pages\PageManager;

trait Seoable
{
    /**
     * Boot the soft deleting trait for a model.
     *
     * @return void
     */
    public static function bootSeoable()
    {
//        $instance = (new static);
//        $binding = camel_case(class_basename(__CLASS__));
//
//        \Route::bind($binding, function ($value) use ($binding){
//            dd($binding);
//            if ($page = Meta::findBySlug($value)) {
//                return $page->metable;
//            }
//            abort(404);
//        });
    }

    public function getSlugSourceAttribute()
    {
        return $this->title;
    }

    /**
     * Get all of the post's comments.
     */
    public function meta()
    {
        return $this->morphOne(Meta::class, 'browseable');
    }

    /**
     * SEO relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoable');
    }

    public function createSeo($attributes = null)
    {
        return app(PageManager::class)->model($this)->handle($attributes);
    }

    public function updateSeo($attributes = null)
    {
        return $this->createSeo($attributes);
    }

    public function deleteSeo()
    {
        return $this->seo->delete();
    }

    public function hasSeo()
    {
        return ! is_null($this->seo);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}