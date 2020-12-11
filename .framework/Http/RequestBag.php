<?php

namespace Nebula\Http;

class RequestBag {
    private static ?RequestBag $instance = null;
    private array $store = [];

    /**
     * Instance
     */
    private static function instance() {
        if (!self::$instance) {
            self::$instance = new RequestBag();
        }

        return self::$instance;
    }

    public function __construct() {
        $this->store = [
            'params' => $_REQUEST,
            'path'   => []
        ];
    }

    /**
     * Get params
     *
     * @param string $type Body | Params
     * @param string|null $key
     * @return array|mixed
     */
    public static function get(string $type, string $key = null) {
        $self = self::instance();
        return $key === null ? $self->store[$type] : $self->store[$type][$key];
    }

    /**
     * Set params
     * 
     * @param string $type Body | Params
     * @param string $key 
     * @param string $value 
     */
    public static function set(string $type, string $key, string $value) {
        $self = self::instance();
        $self->store[$type][$key] = $value;
    }
}
