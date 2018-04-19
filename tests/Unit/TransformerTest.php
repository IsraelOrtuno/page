<?php

namespace Devio\Seo\Tests\Unit;

use Skuad\Seo\Tests\UnitTest;
use Skuad\Seo\Transformers\MetaTransformer;
use Skuad\Seo\Transformers\Transformer;

class TransformerTest extends UnitTest
{
    public function test_transforms_keys_if_method_exist()
    {
        $transformer = new DummyTransformer;

        $result = $transformer->transform(['title' => 'bar']);

        $this->assertEquals('foo', $result['title']);
    }
}

class DummyTransformer extends Transformer
{
    public function setTitle()
    {
        return 'foo';
    }
}