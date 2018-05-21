<?php

namespace Devio\Page;

use Cocur\Slugify\Slugify;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use Sluggable;

    const ROBOTS_INDEX = ['index', 'noindex'];
    const ROBOTS_FOLLOW = ['follow', 'nofollow'];
    const ROBOTS_ADVANCED = ['noimageindex', 'noarchive', 'nosnippet'];

    /**
     * Fillable attributes.
     *
     * @var array
     */
    protected $fillable = ['route', 'slug', 'meta', 'opengraph', 'twitter'];

    /**
     * Casting properties.
     *
     * @var array
     */
    protected $casts = [
        'meta'      => 'object',
        'opengraph' => 'object',
        'twitter'   => 'object'
    ];

    /**
     * Booting the model.
     */
    public static function boot()
    {
        parent::boot();

        // If the user has updated the slug manually, we will make sure that the
        // new slug is unique in the pages table. If we do not check this, it
        // will collision with other slugs and produce unwanted behaviour.
        static::updating(function ($model) {
            if ($model->original['slug'] !== $model->slug) {
                $model->slug = SlugService::createSlug(static::class, 'slug', $model->slug, ['unique' => true]);
            }
        });

        // For the same reason, if the user has specified a slug when creting
        // the resource, we will make sure that this slug is unique by just
        // re-creating the slug again, do not worry about performance.
        static::creating(function($model) {
            $model->slug = SlugService::createSlug(static::class, 'slug', $model->slug, ['unique' => true]);
        });
    }

    /**
     * The polymorphic relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function browseable()
    {
        return $this->morphTo();
    }

    /**
     * Get the current page parent.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

    /**
     * Get all the children of the current page.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(static::class, 'parent_id');
    }

    /**
     * Remove any unwanted slash before setting the slug.
     *
     * @param $value
     */
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = trim($value, '/');
    }

    /**
     * @param \Cocur\Slugify\Slugify $engine
     * @param string $attribute
     * @return \Cocur\Slugify\Slugify
     */
    public function customizeSlugEngine(Slugify $engine, $attribute)
    {
        return new Slugify([
            'regexp' => '/([^A-Za-z0-9\/]|-)+/'
        ]);
    }

    /**
     * Get the slug options.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'method' => function ($value) {
                    return $this->browseable->slugFallback($value);
                }
            ]
        ];
    }
}