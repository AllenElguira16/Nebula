<?php

namespace Nebula\Http;

class Request {
    /**
     * A constant to tell if full uri or not
     */
    const FULL_URI = true;

    /**
     * Returns current URL
     */
    public static function URL() {
        return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }

    /**
     * Returns current URI
     * 
     * @param bool $type 
     */
    public static function URI($type = false) {
        return $type === true ? $_SERVER["REQUEST_URI"] : parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    }

    /**
     * Returns request method 
     * e.g. GET, POST, PUT, PATCH, DELETE,
     */
    public static function requestMethod() {
        return $_SERVER['REQUEST_METHOD'];
    }
    
    /**
     * Get params from body
     */
    public function bodyParams($key = null) {
        return RequestBag::get('body', $key);
    }

    /**
     * Get params from named path parameters
     */
    public function pathParams($key = null) {
        return RequestBag::get('path', $key);
    }
}
