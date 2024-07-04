<?php

namespace App\Application\Attributes;

use Attribute;

#[Attribute]
class Route
{
    public function __construct(
        public string $method,
        public string $path,
        public string $name,
        public string $middleware,
    ) {}
}
