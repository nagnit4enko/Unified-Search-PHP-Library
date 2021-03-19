<?php
/**
 * Created by Prodvnet.
 * User: elnikov.a
 * Date: 28.02.19
 * Time: 11:08
 */

namespace Prodvnet\UnifiedSearch\responseObjects\Indexation;


use GuzzleHttp\Psr7\Response;

class Indexation
{
    /**
     * @var int
     */
    public $statusCode;

    /**
     * @var string
     */
    public $result;

    public function __construct(Response $result)
    {
        $this->statusCode = $result->getStatusCode();
        $this->result = $result->getReasonPhrase();
    }
}