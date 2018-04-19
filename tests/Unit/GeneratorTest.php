<?php

namespace Devio\Page\Tests\Unit;

use Arcanedev\SeoHelper\Contracts\SeoHelper;
use Mockery as m;
use Skuad\Seo\Generators\MetaGenerator;
use Skuad\Seo\Tests\UnitTest;

class GeneratorTest extends UnitTest
{
    public function test_setters_are_called_if_exist()
    {
        $helper = m::mock(SeoHelper::class);

        $helper->shouldReceive('setTitle')->once()->with('Page title');
        $helper->shouldReceive('setDescription')->once()->with('Page description');

        $instance = new MetaGenerator($helper);

        $instance->handle(['title' => 'Page title', 'description' => 'Page description']);
    }

    public function test_setters_are_not_called_if_not_found()
    {
        $helper = m::mock(SeoHelper::class);

        $helper->shouldNotReceive('setTitle');
        $helper->shouldNotReceive('setDescription');

        $instance = new MetaGenerator($helper);

        $instance->handle(['foo' => 'xxx', 'bar' => 'xxx']);
    }
}