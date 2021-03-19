<?php
/**
 * Created by Prodvnet.
 * User: elnikov.a
 * Date: 28.02.19
 * Time: 11:49
 */

namespace Prodvnet\UnifiedSearch\responseObjects\Indexation;


class IndexationProgress
{
    /**
     * @var int
     */
    public $indexationProgress;

    public function __construct($data)
    {
        $this->indexationProgress = json_decode($data->getBody())->indexationProgress;
    }
}