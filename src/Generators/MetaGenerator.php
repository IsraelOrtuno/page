<?php

namespace Devio\Pages\Generators;

class MetaGenerator extends AbstractGenerator
{
    /**
     * Set the title tag content.
     * <title>
     *
     * @param $content
     */ // TODO: make protected
    public function setTitle($content)
    {
        $this->helper->setTitle($this->compile($content));
    }

    /**
     * Set the meta description.
     * <meta name="description">
     *
     * @param $content
     */
    protected function setDescription($content)
    {
        $this->helper->setDescription($this->compile($content));
    }

    /**
     * Set the robots values.
     * <meta name="robots">
     *
     * @param $content
     */
    protected function setRobots($content)
    {
        $this->helper->meta()->getMiscEntity()->add('robots', $content);
    }

    /**
     * Set the canonical URL.
     * <meta name="canonical">
     *
     * @param $content
     */
    protected function setCanonical($content)
    {
        $this->helper->meta()->getMiscEntity()->setUrl($content);
    }
}