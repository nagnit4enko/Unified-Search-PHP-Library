<?php
/**
 * Created by Prodvnet.
 * User: elnikov.a
 * Date: 26.02.19
 * Time: 9:05
 */

namespace Prodvnet\UnifiedSearch\responseObjects\Offers;


use GuzzleHttp\Psr7\Response;
use Prodvnet\UnifiedSearch\Request;

class DownloadFile
{
    public function __construct(Response $data, Request $request)
    {
        self::downloadFile($data, $request);
    }

    public static function downloadFile(Response $data, Request $request)
    {
        $filename = $request->getParams()['fileName'];
        $content  = $data->getBody()->getContents();

        header("Content-Disposition: attachment; filename=\"" . basename($filename) . "\"");
        header("Content-Type: application/force-download");
        header("Connection: close");
        echo $content;
        die();
    }
}