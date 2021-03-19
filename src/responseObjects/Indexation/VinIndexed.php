<?php
/**
 * Created by Prodvnet.
 * User: elnikov.a
 * Date: 28.02.19
 * Time: 11:40
 */

namespace Prodvnet\UnifiedSearch\responseObjects\Indexation;


class VinIndexed
{
    /**
     * @var boolean
     */
    public $vinIndexed;

    public function __construct($data)
    {
        $this->vinIndexed = json_decode($data->getBody())->vinIndexed;
    }
}