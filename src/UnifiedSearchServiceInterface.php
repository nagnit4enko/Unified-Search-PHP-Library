<?php
/**
 * Created by Prodvnet.
 * User: elnikov.a
 * Date: 20.02.19
 * Time: 13:41
 */

namespace Prodvnet\UnifiedSearch;

/**
 * Interface UnifiedSearchServiceInterface
 * @package Prodvnet\UnifiedSearch
 */
interface UnifiedSearchServiceInterface
{
    /**
     * UnifiedSearchServiceInterface constructor.
     * @param Config $config
     */
    public function __construct(Config $config);

    /**
     * @param int $id
     * @return $this
     */
    public function getTaskById(int $id);

    /**
     * @param array $params
     * @return $this
     */
    public function getTaskList(array $params);

    /**
     * @param int $id
     * @return $this
     */
    public function cancelTask(int $id);

    /**
     * @param string $string
     * @param array $params
     * @return $this
     */
    public function search(string $string, array $params);

    /**
     * @param array $oems
     * @param string $vin
     * @param bool $withOffers
     * @param bool $inStock
     * @return $this
     */
    public function searchByOems(array $oems, string $vin, bool $withOffers = false, $inStock = false);

    /**
     * @param string $string
     * @return $this
     */
    public function completeQuery(string $string);

    /**
     * @param string $vin
     * @param string $detailId
     * @return $this
     */
    public function searchOriginalDetails(string $vin, string $detailId);

    /**
     * @param string $name
     * @return $this
     */
    public function removeFile(string $name);

    /**
     * @param array $params
     * @return $this
     */
    public function getFilesList(array $params);

    /**
     * @param string $name
     * @return $this
     */
    public function downloadFile(string $name);

    /**
     * @param $file
     * @param $name
     * @return $this
     */
    public function uploadFile($file, string $name);

    /**
     * @param $name
     * @return $this
     */
    public function processFile(string $name);

    /**
     * @param string $vin
     * @param string $ssd
     * @param string $locale
     * @return $this
     */
    public function identifyVehicle(string $vin, string $ssd, string $locale);

    /**
     * @param string $vin
     * @param string|null $ssd
     * @return $this
     */
    public function indexVin(string $vin, string $ssd = null);

    /**
     * @param string $vin
     * @return $this
     */
    public function getVehicleInfo(string $vin);

    /**
     * @param string $vin
     * @return $this
     */
    public function vinIndexed(string $vin);

    /**
     * @param string $vin
     * @return $this
     */
    public function getVinProgress(string $vin);

    /**
     * @return array
     */
    public function query();

    /**
     * @return string
     */
    public function getLastRequestText();

    /**
     * @return $this
     */
    public function getUserInfo();

    public function setLastRequestText(string $lastRequestText);
}