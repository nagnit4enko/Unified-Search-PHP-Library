<?php
namespace Prodvnet\UnifiedSearch\responseObjects\Offers;

use GuzzleHttp\Psr7\Response;
use Prodvnet\UnifiedSearch\Request;
use Prodvnet\UnifiedSearch\responseObjects\ListObject;

/**
 * Created by Prodvnet.
 * User: elnikov.a
 * Date: 22.02.19
 * Time: 15:57
 */


class FilesList extends ListObject
{
    /**
     * @var array
     */
    public $files;

    public function __construct(Response $data,  Request $request)
    {
        $body = json_decode($data->getBody()->getContents());

        $this->createListObject($body);

        foreach ($body->data as $file) {
            $this->files[] = new File($file);
        }
    }
}