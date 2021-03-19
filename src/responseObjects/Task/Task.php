<?php

namespace Prodvnet\UnifiedSearch\responseObjects\Task;
use GuzzleHttp\Psr7\Response;

/**
 * Created by Prodvnet.
 * User: elnikov.a
 * Date: 25.02.19
 * Time: 10:49
 */
class Task
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $status;

    /**
     * @var string
     */
    public $realm;

    /**
     * @var int
     */
    public $progressPercent;

    /**
     * @var \DateTime
     */
    public $startAt;

    /**
     * @var \DateTime
     */
    public $finishAt;

    /**
     * @var \stdClass
     */
    public $statistics;

    /**
     * @var string
     */
    public $errorMessage;

    public function __construct($task)
    {
        /**
         * @var \stdClass|Response $task
         */
        if (!$task instanceof \stdClass) {
            $body = json_decode($task->getBody());
        } else {
            $body = $task;
        }

        $this->responseText = (!$task instanceof \stdClass) ? $task->getBody()->getContents() : json_encode($task);

        foreach ($body as $key => $value) {
            if ($key === 'startAt' || $key === 'finishAt') {
                $value = new \DateTime($value);
            }

            $this->{$key} = $value;
        }
    }
}