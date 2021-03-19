<?php
namespace Prodvnet\UnifiedSearch\responseObjects;

/**
 * Created by Prodvnet.
 * User: elnikov.a
 * Date: 22.02.19
 * Time: 15:33
 */
use GuzzleHttp\Psr7\Response;
use Prodvnet\UnifiedSearch\Request;

class UnifiedSearchResponse
{
    const __OBJECTS_COMPARISON__ = [
        'GET:task'                         => 'Task\TaskList',
        'GET:search/search'                => 'Search\SearchResult',
        'GET:search/searchTag'             => 'Search\SearchResult',
        'GET:search/searchOriginalDetails' => 'Search\SearchResult',
        'GET:search/complete'              => 'Search\Autocomplete',
        'GET:task/id'                      => 'Task\Task',
        'POST:search/searchByOems'         => 'Search\DetailsByOems',
        'GET:offers/list'                  => 'Offers\FilesList',
        'GET:offers/download'              => 'Offers\DownloadFile',
        'POST:offers/upload'               => 'Offers\UploadFile',
        'POST:offers/process'              => 'Offers\ProcessFile',
        'DELETE:offers'                    => 'Offers\UploadFile',
        'GET:vehicle/identify'             => 'Indexation\VehiclesList',
        'POST:vehicle/index'               => 'Indexation\Indexation',
        'GET:vehicle/info'                 => 'Indexation\Vehicle',
        'GET:vehicle/vinIndexed'           => 'Indexation\VinIndexed',
        'GET:vehicle/vinProgress'          => 'Indexation\IndexationProgress',
        'GET:userInfo'                     => 'UserInfo\UserInfo'
    ];

    public static function getResponseObject($response = null, $request) {

        if ($response) {
            return self::createObject($response, $request);
        }

        return false;
    }

    private static function createObject(Response $data, Request $request) {
        if ($objectType = self::__OBJECTS_COMPARISON__[$request->getPath()]) {
            $className = __NAMESPACE__ . '\\' . ucfirst($objectType);

            $obj = new $className($data, $request);
            $requestBody = json_encode($request->getBody());
            return $obj;

        } else {
            throw new \Exception('Unsupported object type');
        }
    }
}