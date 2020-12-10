<?php

namespace Nebula;
/**
 * Use only in development
 */
class Console {
    /**
     * send a log message to the STDOUT stream.
     *
     * @param array<int, mixed> $args
     *
     * @return void
     */
    public static function log(...$args): void {
        // print_r($args);

        file_put_contents("php://stdout", implode(" ", $args));
    }

    /**
     * Clear terminal output
     * 
     * @return void
     */
    public static function clear(): void {
        echo chr(27).chr(91).'H'.chr(27).chr(91).'J';
    }
}