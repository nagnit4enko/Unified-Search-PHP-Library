<?php
/**
 * Created by Prodvnet.
 * User: elnikov.a
 * Date: 22.02.19
 * Time: 16:13
 */

namespace Prodvnet\UnifiedSearch\responseObjects\Task;


use GuzzleHttp\Psr7\Response;
use Prodvnet\UnifiedSearch\Request;
use Prodvnet\UnifiedSearch\responseObjects\ListObject;

class TaskList extends ListObject
{
    /**
     * @var array|Task
     */
    public $tasks = [];

    public function __construct(Response $data, Request $request)
    {
        $body = json_decode($data->getBody()->getContents());
        $this->responseText = $data->getBody()->getContents();


        $this->createListObject($body);

        foreach ($body->data as $task) {
            $this->tasks[] = new Task($task);
        }
    }
}