<?php
/**
 * Created by Prodvnet.
 * User: elnikov.a
 * Date: 26.02.19
 * Time: 8:53
 */

namespace Prodvnet\UnifiedSearch\responseObjects\Offers;

use Prodvnet\UnifiedSearch\UnifiedSearchService;

class File
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var \DateTime
     */
    public $createdAt;

    /**
     * @var \DateTime
     */
    public $lastModifiedAt;

    public function __construct($file)
    {
        $this->name           = $file->name;
        $this->responseText   = json_encode($file);
        $this->createdAt      = new \DateTime($file->createdAt);
        $this->lastModifiedAt = new \DateTime($file->lastModifiedAt);
    }

    public function download() {
        $app = UnifiedSearchService::getApp();
        $app->downloadFile($this->name)->query();
    }
}