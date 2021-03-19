<?php
namespace Prodvnet\UnifiedSearch\responseObjects\Search;

/**
 * Created by Prodvnet.
 * User: elnikov.a
 * Date: 25.02.19
 * Time: 16:08
 */



use GuzzleHttp\Psr7\Response;
use Prodvnet\UnifiedSearch\Request;

class DetailsByOems
{
    /**
     * @var array
     */
    public $details;

    public function __construct(Response $data,  Request $request)
    {
        $response           = $data->getBody()->getContents();
        $body               = json_decode($response);
        $this->details      = $body->detailsByOems;
        $this->responseText = $response;
    }
}