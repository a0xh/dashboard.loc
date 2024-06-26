<?php

namespace App\Application\Attributes;

use Attribute;

#[Attribute]
class Route
{
    public array $args;

    public function __construct(string $method, string $path, string $name, string $middleware)
    {
        $this->args = func_get_args();
    }
}
