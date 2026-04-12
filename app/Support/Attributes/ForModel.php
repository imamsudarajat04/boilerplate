<?php

namespace App\Support\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
final class ForModel
{
    public function __construct(
        public readonly string $modelClass
    ) {}
}
