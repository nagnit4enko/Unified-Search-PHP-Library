<?php
/**
 * Created by Prodvnet.
 * User: elnikov.a
 * Date: 25.02.19
 * Time: 11:20
 */

namespace Prodvnet\UnifiedSearch\responseObjects\Search;


use GuzzleHttp\Psr7\Response;
use Prodvnet\UnifiedSearch\responseObjects\ListObject;

class SearchResult extends ListObject
{
    /**
     * @var string
     */
    public $autodetectedVin;

    /**
     * @var boolean
     */
    public $autodetectedVinIndexed;

    /**
     * @var array
     */
    public $autodetectedBrands;

    /**
     * @var array
     */
    public $autodetectedOems;

    /**
     * @var array
     */
    public $autodetectedTechCodes;

    /**
     * @var array
     */
    public $autodetectedModels;

    /**
     * @var array
     */
    public $undetectedTerms;

    /**
     * @var \stdClass
     */
    public $explanation;

    /**
     * @var array
     */
    public $details;

    /**
     * @var array
     */
    public $categories;

    /**
     * @var array
     */
    private $errors;

    /**
     * @var array
     */
    public $suggestions;

    /**
     * @var array
     */
    public $suggestedQueries;

    /**
     * @var array
     */
    public $originalDetails;

    /**
     * @var string
     */
    public $responseText;

    
    function __construct(Response $data)
    {
        $this->responseText = $data->getBody()->getContents();
        $body = json_decode($this->responseText);

        foreach ($body as $key => $item) {
            $this->{$key} = $item;
        }

        if (!empty($body->total)) {
            $this->createListObject($body);
        }
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}