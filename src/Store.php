<?php

namespace Devio\Page;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Container\Container;

class Store
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * The model instance.
     *
     * @var Model
     */
    protected $model;

    /**
     * Manager constructor.
     *
     * @param Model|null $model
     */
    public function __construct(Model $model = null)
    {
        $this->model = $model;
    }

    /**
     * Set the model.
     *
     * @param Model $model
     * @return $this
     */
    public function model(Model $model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Create or update the seo model for the current model.
     *
     * @param null $attributes
     */
    public function handle($attributes = null)
    {
        $attributes = $this->gatherAttributes($attributes)->map(function ($values, $entity) {
            return $this->getContainer()->has($alias = "page.transformers.{$entity}") ?
                $this->getContainer()->make($alias)->transform($values) : $values;
        })->toArray();

        // We will first use the transformers to manipulate any entity data if
        // there is a transformer for it. Once done our attributes are ready
        // to be persisted... We will create or update them accordingly.
        return $this->model->hasPage() ? $this->model->page->update($attributes)
            : $this->model->page()->create($attributes);
    }

    /**
     * Get the attributes from the request or 'seo' key.
     *
     * @param null $attributes
     * @return \Illuminate\Support\Collection
     */
    protected function gatherAttributes($attributes = null)
    {
        if (is_null($attributes)) {
            $attributes = request()->get('page');
        }

        if ($attributes instanceof Request) {
            $attributes = $attributes->get('page');
        } elseif (! is_array($attributes)) {
            $attributes = (array) $attributes;
        }

        return collect($attributes['page'] ?? $attributes);
    }

    /**
     * Get the container instance.
     *
     * @return Container
     */
    public function getContainer()
    {
        if (is_null($this->container)) {
            $this->container = \Illuminate\Container\Container::getInstance();
        }

        return $this->container;
    }

    /**
     * Set the container instance.
     *
     * @param Container $container
     * @return $this
     */
    public function setContainer(Container $container)
    {
        $this->container = $container;

        return $this;
    }
}