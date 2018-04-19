<?php

namespace Devio\Pages\Contracts;

interface PageResolver
{
    public function resolve(\Devio\Pages\Page $page): string;
}