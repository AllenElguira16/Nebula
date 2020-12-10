<?php

namespace Nebula\Routing\Attributes;
    
#[\Attribute(\Attribute::TARGET_METHOD)]
final class Get {
    public function __construct(public $uri = '') {}
}
