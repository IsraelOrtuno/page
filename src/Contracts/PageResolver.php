<?php

namespace Devio\Seo\Contracts;

interface PageResolver
{
    public function resolve(\Devio\Seo\Page $page): string;
}