<?php

namespace Devio\Page\Contracts;

interface PageResolver
{
    public function resolve(\Devio\Page\Page $page): string;
}