<?php
/**
 * Created by Prodvnet.
 * User: elnikov.a
 * Date: 27.02.19
 * Time: 11:17
 */

namespace Prodvnet\UnifiedSearch\responseObjects\Offers;


use GuzzleHttp\Psr7\Response;

class ProcessFile
{
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $reasonPhrase;

    /**
     * @var int
     */
    public $statusCode;

    /**
     * @var array
     */
    public $headers;

    public function __construct(Response $file)
    {
        $body = json_decode($file->getBody()->getContents());
        $this->id = $body->id;
        $this->reasonPhrase = $file->getReasonPhrase();
        $this->statusCode   = $file->getStatusCode();
        $this->headers      = $file->getHeaders();
    }
}