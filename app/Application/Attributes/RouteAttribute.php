<?php

namespace App\Application\Attributes;

use Attribute;

#[Attribute]
class Route
{
    public array $args;

    public function __construct(string $path, string $name, string $method)
    {
        $this->args = func_get_args();
    }
}