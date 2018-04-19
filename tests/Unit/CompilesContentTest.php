<?php

namespace Devio\Pages\Tests\Unit;

use Skuad\Seo\Tests\UnitTest;
use Skuad\Seo\Generators\Concerns\CompilesContent;

class CompilesContentTest extends UnitTest
{
    public function test_an_array_of_sources_is_automatically_created()
    {
        $compiler = (new CompilerClass)->sources(['foo' => 'bar']);

        $this->assertTrue(is_array($compiler->getSources()));
    }

    public function test_compiles_content_between_tags()
    {
        $user = 'test';
        $compiler = (new CompilerClass)->sources(compact('user'));

        $result = $compiler->compile('hello {{$user}}');

        $this->assertEquals('hello test', $result);
    }

    public function test_trims_spaces_between_tags()
    {
        $user = 'foo';
        $compiler = (new CompilerClass)->sources(compact('user'));

        $result = $compiler->compile('hello {{ $user }}');

        $this->assertEquals('hello foo', $result);
    }

    public function test_can_compile_multiple_statements()
    {
        $user = 'foo';
        $location = 'bar';
        $compiler = (new CompilerClass)->sources(compact('user', 'location'));

        $result = $compiler->compile('{{$user}} lives in {{$location}}');

        $this->assertEquals('foo lives in bar', $result);
    }

    public function test_standalone_statements_are_compiled()
    {
        $user = 'foo';
        $compiler = (new CompilerClass)->sources(compact('user'));

        $result = $compiler->compile('{{$user}}');

        $this->assertEquals('foo', $result);
    }

    public function test_compiles_content_from_objects()
    {
        $user = (object) ['name' => 'Israel', 'country' => 'Spain'];
        $compiler = (new CompilerClass)->sources(compact('user'));

        $result = $compiler->compile('{{$user->name}} lives in {{$user->country}}');

        $this->assertEquals('Israel lives in Spain', $result);
    }

    public function test_executes_functions_from_objects()
    {
        $user = (new class
        {
            function name()
            {
                return 'Israel';
            }
        });

        $compiler = (new CompilerClass)->sources(compact('user'));

        $result = $compiler->compile('My name is {{$user->name()}}');

        $this->assertEquals('My name is Israel', $result);
    }
}

class CompilerClass
{
    use CompilesContent;

    public function user()
    {
        return 'Israel';
    }
}