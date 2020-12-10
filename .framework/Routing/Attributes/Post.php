<?php

namespace Nebula\Routing\Attributes;
    
#[\Attribute(\Attribute::TARGET_METHOD)]
final class Post {
    public function __construct(private $uri = '/') {}
}
