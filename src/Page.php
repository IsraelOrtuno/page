<?php

namespace Devio\Seo;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    const ROBOTS_INDEX = ['index', 'noindex'];
    const ROBOTS_FOLLOW = ['follow', 'nofollow'];
    const ROBOTS_ADVANCED = ['noimageindex', 'noarchive', 'nosnippet'];

    /**
     * Fillable attributes.
     *
     * @var array
     */
    protected $fillable = ['meta', 'opengraph', 'twitter'];

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
}