<?php

namespace Devio\Page\Tests\Unit;

use Mockery as m;
use Skuad\Seo\Seo;
use Skuad\Seo\Manager;
use Skuad\Seo\Tests\UnitTest;
use Skuad\Seo\Transformers\MetaTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Container\Container;

class ManagerTest extends UnitTest
{
    public function test_create_seo_values_if_do_not_exist()
    {
        $user = m::mock(User::class);
        $seo = m::mock(Seo::class);
        $container = m::mock(Container::class);

        $user->shouldIgnoreMissing()->shouldReceive('seo')->andReturn($seo);

        $seo->shouldReceive('create')->once();
        $container->shouldReceive('make')->with('seo.transformers.meta')->andReturn(new MetaTransformer);

        $manager = (new Manager($user))->setContainer($container);

        $manager->handle(['meta' => ['title' => 'test']]);
    }

    public function test_update_seo_values_if_already_exist()
    {
        $user = new User;
        $seo = m::mock(Seo::class);
        $container = m::mock(Container::class);

        $user->setRelation('seo', $seo);

        $seo->shouldReceive('update')->once();
        $container->shouldReceive('make')->with('seo.transformers.meta')->andReturn(new MetaTransformer);

        $manager = (new Manager($user))->setContainer($container);

        $manager->handle(['meta' => ['title' => 'test']]);
    }

    public function test_()
    {

    }
}

class User extends Model
{
}