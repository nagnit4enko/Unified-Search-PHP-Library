<?php
namespace Prodvnet\UnifiedSearch\responseObjects\Indexation;
use GuzzleHttp\Psr7\Response;
use Prodvnet\UnifiedSearch\Request;
use Prodvnet\UnifiedSearch\responseObjects\ListObject;

/**
 * Created by Prodvnet.
 * User: elnikov.a
 * Date: 27.02.19
 * Time: 17:39
 */
class VehiclesList extends ListObject
{
    /**
     * @var array
     */
    public $vehicles;

    public function __construct(Response $data, Request $request)
    {
        $body = json_decode($data->getBody()->getContents());

        foreach ($body->vehicles as $vehicle) {
            $this->vehicles[] = new Vehicle($vehicle);
        }
    }
}