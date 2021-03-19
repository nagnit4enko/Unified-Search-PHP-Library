<?php
/**
 * Created by Prodvnet.
 * User: elnikov.a
 * Date: 25.02.19
 * Time: 11:24
 */

namespace Prodvnet\UnifiedSearch\responseObjects;


class ListObject
{
    /**
     * @var int
     */
    private $total = 0;

    /**
     * @var int
     */
    private $limit = 0;

    /**
     * @var int
     */
    private $skip = 0;

    /**
     * @var string
     */
    public $responseText;

    function createListObject($body)
    {
        $this->total        = $body->total;
        $this->skip         = $body->skip;
        $this->limit        = $body->limit;
        $this->responseText = json_encode($body);
    }

    /**
     * @return int
     */
    public function getSkip(): int
    {
        return $this->skip;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }
}