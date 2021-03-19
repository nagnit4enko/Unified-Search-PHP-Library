<?php

namespace Prodvnet\UnifiedSearch;

use GuzzleHttp\Client;
use Prodvnet\UnifiedSearch\responseObjects\UnifiedSearchResponse;

/**
 * Class UnifiedSearchService
 * @package Prodvnet\UnifiedSearch
 */
class UnifiedSearchService implements UnifiedSearchServiceInterface
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var array
     */
    private $requests;

    /**
     * @var array
     */
    private $responses;

    /**
     * @var $this
     */
    public static $instance;

    /**
     * @var boolean
     */
    public $unavailable = false;

    /**
     * @var string
     */
    public $errorMessage;

    /**
     * @var string
     */
    private $fileName;

    /**
     * @var string
     */
    private $lastRequestText;

    public function createRequest($method, $controller, $action, $id = null, $params = [], $cancel = false, $body = null, $file = null) {
        $this->requests[] = new Request($method, $controller, $action, $id, $params, $cancel, $body, $file);
    }

    public function __construct(Config $config)
    {
        self::$instance = $this;
        $this->config = $config;
    }

    public function getTaskById(int $id) {
        $this->createRequest('GET', 'task', '', $id);

        return $this;
    }

    public function getTaskList(array $params = []) {
        $this->createRequest('GET', 'task', '', null, $params);

        return $this;
    }

    public function cancelTask(int $id) {
        $this->createRequest('GET', 'task', '', $id, [], true);

        return $this;
    }

    public function search(string $string, array $params) {
        $params['query'] = $string;

        $this->createRequest('GET', 'search', 'search', null, $params);

        return $this;
    }

    public function searchTags(string $string, array $params) {
        $params['query'] = $string;

        $this->createRequest('GET', 'search', 'searchTag', null, $params);

        return $this;
    }

    public function searchByOems(array $oems, string $vin, bool $withOffers = false, $inStock = false) {
        $body = [];

        $body['oems']       = $oems;
        $body['vin']        = $vin;
        $body['withOffers'] = $withOffers;
        $body['inStock']    = $inStock;

        $this->createRequest('POST', 'search', 'searchByOems', null, [], false, $body);

        return $this;
    }

    public function completeQuery(string $string) {
        $params['incompleteQuery'] = $string;

        $this->createRequest('GET', 'search', 'complete', null, $params);

        return $this;
    }

    public function searchOriginalDetails(string $vin, string $detailId) {
        $params['vin']      = $vin;
        $params['detailId'] = $detailId;

        $this->createRequest('GET', 'search', 'searchOriginalDetails', null, $params);

        return $this;
    }

    public function removeFile(string $name) {
        $params['fileName'] = $name;
        $this->createRequest('DELETE', 'offers', '', null, $params);

        return $this;
    }

    public function getFilesList(array $params = []) {
        $this->createRequest('GET', 'offers', 'list', null, $params);

        return $this;
    }

    public function downloadFile(string $name) {
        $params['fileName'] = $name;

        $this->createRequest('GET', 'offers', 'download', null, $params);

        return $this;
    }

    public function uploadFile($file, string $name) {
        $this->fileName = $name;

        $this->createRequest('POST', 'offers', 'upload', null, [], false, null, $file);

        return $this;
    }

    public function processFile(string $name) {
        $this->fileName = $name;
        $params['fileName'] = $name;
        $this->createRequest('POST', 'offers', 'process', null, $params);

        return $this;
    }

    public function identifyVehicle(string $vin, string $ssd = null, string $locale = null) {
        $params['vin']    = $vin;
        $params['ssd']    = $ssd;
        $params['locale'] = $locale;

        foreach ($params as $key => $param) {
            if (!$param) {
                unset($params[$key]);
            }
        }

        $this->createRequest('GET', 'vehicle', 'identify', null,  $params);

        return $this;
    }

    public function indexVin(string $vin, string $ssd = null) {
        $params['vin'] = $vin;
        $params['ssd'] = $ssd;

        $this->createRequest('POST', 'vehicle', 'index', null, $params);

        return $this;
    }

    public function getVehicleInfo(string $vin) {
        $params['vin'] = $vin;

        $this->createRequest('GET', 'vehicle', 'info', null, $params);

        return $this;
    }

    public function vinIndexed(string $vin) {
        $params['vin'] = $vin;

        $this->createRequest('GET', 'vehicle', 'vinIndexed', null, $params);

        return $this;
    }

    public function getVinProgress(string $vin) {
        $params['vin'] = $vin;

        $this->createRequest('GET', 'vehicle', 'vinProgress', null, $params);

        return $this;
    }

    public function getUserInfo() {
        $this->createRequest('GET', 'userInfo', '', null);

        return $this;
    }

    function query()
    {
        $client = new Client();

        foreach ($this->requests as $usearchRequest) {
            $url = $this->config->getServiceUrl() . $usearchRequest->getUrl();
            $options = [
                'auth' => [
                    $this->config->getLogin(), $this->config->getPassword()
                ],
                'json' => $usearchRequest->getBody()
            ];

            if ($file = $usearchRequest->getFile()) {
                unset($options['json']);

                $options['multipart'] = [
                    [
                        'name'     => 'offersFile',
                        'contents' => fopen($file, 'r'),
                        'filename' => $this->fileName,
                        'headers'  => [
                            'Authorization' => $this->config->getLogin() . ' ' . $this->config->getPassword()
                        ]
                    ]
                ];
            }

            try {
                $request = $client->request($usearchRequest->getMethod(), $url, $options);
                $this->setLastRequestText($usearchRequest->getMethod() . ': ' . $url);
                $this->responses[] = UnifiedSearchResponse::getResponseObject($request, $usearchRequest);
            } catch (\Exception $ex) {
                if (!$ex->getCode()) {
                    $this->unavailable = true;
                    $this->errorMessage = $ex->getMessage();
                }
                return $ex->getCode() . ': ' . $ex->getMessage();
            } catch (\Throwable $ex) {
                return $ex->getCode() . ': ' . $ex->getMessage();
            }
        }

        $this->requests = [];
        return $this->responses;
    }

    public static function getApp() {
        return self::$instance;
    }

    /**
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this->config;
    }

    /**
     * @return string || null
     */
    public function getLastRequestText()
    {
        return $this->lastRequestText;
    }

    /**
     * @param string $lastRequestText
     */
    public function setLastRequestText(string $lastRequestText)
    {
        $this->lastRequestText = $lastRequestText;
    }
}
