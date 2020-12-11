<?php

namespace Nebula;

use Nebula\Console;

class CLI {
    private string $type;

    public function __construct() {
        $this->type = $_SERVER['argv'][1];
    }

    /**
     * Start Server
     */
    public function start() {

        // register_shutdown_function(function() {
        //     // Console::log('Exiting...');
        //     echo 'Script executed with success', PHP_EOL;
        // });

        $PORT = 8000;

        function execInBackground($cmd) {   
            exec($cmd . " 2> logs/server-logs.txt &");
        }

        Console::clear();
        Console::log("Localhost started on port {$PORT}");

        execInBackground("php.exe -S localhost:{$PORT} -t ./public");

        sapi_windows_set_ctrl_handler(function($handler) {
            
            Console::log('Exiting...');
            sleep(2);
            exit();
        });
    }

    /**
     * Run Command Line Interface for nebula
     * 
     * @TODO: Add more features such as add controller, add database, migrations and etc...
     */
    public function run() {
        switch ($this->type) {
            case 'serve':
                $this->start();
                break;
            
            default:
                Console::log("Command `{$this->type}` does not exists!");
                break;
        }
    }
}
