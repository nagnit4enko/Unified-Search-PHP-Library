<?php
/**
 * Created by Prodvnet.
 * User: elnikov.a
 * Date: 27.02.19
 * Time: 17:47
 */

namespace Prodvnet\UnifiedSearch\responseObjects\Indexation;


class Vehicle
{
    public function __construct($vehicle)
    {
        if (!$vehicle instanceof \stdClass) {
            $body = json_decode($vehicle->getBody());
        } else {
            $body = $vehicle;
        }

        foreach ($body as $key => $param) {
            $this->{$key} = $param;
        }
    }
}