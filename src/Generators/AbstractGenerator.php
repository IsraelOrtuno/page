<?php

namespace Devio\Page\Generators;

use Arcanedev\SeoHelper\Contracts\SeoHelper;
use Devio\Page\Generators\Concerns\CompilesContent;

abstract class AbstractGenerator
{
    use CompilesContent;

    /**
     * @var SeoHelper
     */
    protected $helper;

    /**
     * MetaGenerator constructor.
     *
     * @param SeoHelper $helper
     */
    public function __construct(SeoHelper $helper)
    {
        $this->helper = $helper;
    }

    public function handle($data = [])
    {
        if (is_null($data)) {
            return;
        }

        foreach ($data as $key => $content) {
            if (method_exists($this, $method = 'set' . studly_case($key))) {
                call_user_func_array([$this, $method], compact('content'));
            }
        }
    }
}