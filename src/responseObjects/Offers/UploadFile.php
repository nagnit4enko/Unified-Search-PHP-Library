<?php
/**
 * Created by Prodvnet.
 * User: elnikov.a
 * Date: 27.02.19
 * Time: 11:17
 */

namespace Prodvnet\UnifiedSearch\responseObjects\Offers;


use GuzzleHttp\Psr7\Response;

class UploadFile
{
    /**
     * @var string
     */
    public $name;
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
        $this->reasonPhrase = $file->getReasonPhrase();
        $this->statusCode   = $file->getStatusCode();
        $this->headers      = $file->getHeaders();
    }
}