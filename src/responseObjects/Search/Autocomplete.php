<?php
/**
 * Created by Prodvnet.
 * User: elnikov.a
 * Date: 30.05.19
 * Time: 12:25
 */

namespace Prodvnet\UnifiedSearch\responseObjects\Search;

use GuzzleHttp\Psr7\Response;


class Autocomplete
{
    /**
     * @var array
     */
    public $queryCompletions;

    /**
     * @var string
     */
    public $responseText;

    function __construct(Response $data)
    {
        $this->responseText = $data->getBody()->getContents();
        $body = json_decode($this->responseText);

        $this->queryCompletions = $body->queryCompletions;
    }
}