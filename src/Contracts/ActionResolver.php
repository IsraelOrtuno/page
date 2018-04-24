<?php

namespace Devio\Page\Contracts;

interface ActionResolver
{
    public function resolve(\Devio\Page\Page $page): string;
}