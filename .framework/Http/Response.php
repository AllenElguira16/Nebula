<?php 

namespace Nebula\Http;

/**
 * Response class
 */
class Response
{
    // /**
    //  * Setting Contents and Headers
    //  *
    //  * @param mix $content
    //  * @param mix $headers
    //  * @param integer $code
    //  */
    // public function __construct(private $content = '', private $headers = [], private int $code = 200) {}

    /**
     * Renders content to the Browser e.g. Chrome, Firefox, Edge
     *
     * @return string
     */
    public function send($content): string
    {
        $this->header('Content-Type', 'application/json');
        // $this->setHeader();
        return json_encode($content);
    }

    /**
     * Set multiple headers
     *
     * @return void
     */
    public function setHeader($headers): void
    {
        foreach ($headers as $content => $mime) {
            $this->header($content, $mime);
        }
    }

    /**
     * Set multiple headers
     *
     * @param string $content
     * @param string $type
     * @return void
     */
    public function header(string $content, string $mime = null): void
    {
        if ($mime) {
            header("$content: $mime; charset=UTF-8");
        } else {
            header($content);
        }
    }

    // /**
    //  * 
    //  */
    // public function redirect($to)
    // {
    //     $this->header("Location: $to");
    // }
}
