<?php

namespace Devio\Page;

use Illuminate\Contracts\Container\Container;

class PageManager
{
    /**
     * @var Container
     */
    protected $container;

    public function generate($generator, $data = [])
    {
        $this->getContainer()->make($generator)->handle($data);
    }

    public function generateAll($data = [])
    {
        if (is_callable($data)) {
            $data = $data();
        }
        if ($data instanceof Page) {
            $data = $data->toArray();
        }

        $data = array_only($data, ['meta']); // , 'opengraph', 'twitter']);

        foreach ($data as $generator => $attributes) {
            $this->generate("page.generator.{$generator}", $attributes);
        }
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