<?php
/**
 * Created by Prodvnet.
 * User: elnikov.a
 * Date: 17.07.2019
 * Time: 14:21
 */
namespace Prodvnet\UnifiedSearch\responseObjects\UserInfo;

use GuzzleHttp\Psr7\Response;

class UserInfo
{
    /**
     * @var string
     */
    public $login;

    /**
     * @var array
     */
    public $searchOptions;

    public function __construct($userInfo)
    {
        /**
         * @var \stdClass|Response $task
         */
        if (!$userInfo instanceof \stdClass) {
            $body = json_decode($userInfo->getBody());
        } else {
            $body = $userInfo;
        }

        $this->responseText = (!$userInfo instanceof \stdClass) ? $userInfo->getBody()->getContents() : json_encode($userInfo);

        foreach ($body as $key => $value) {
            $this->{$key} = $value;
        }
    }
}