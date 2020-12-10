<?php

namespace Nebula\Routing\Attributes;

#[\Attribute(\Attribute::TARGET_CLASS)]
class Controller {
    public function __construct(public $prefix) {}
}
