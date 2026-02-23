<?php

declare(strict_types=1);

namespace K8Schema\Api\Node\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringOrFloatMap;

/**
 * Overhead structure represents the resource overhead associated with running a
 * pod.
 */
class Overhead implements JsonSerializable
{
    /**
     * podFixed represents the fixed resource overhead associated with running a pod.
     */
    private StringOrFloatMap $podFixed;

    public function __construct()
    {
        $this->podFixed = new StringOrFloatMap();
    }

    public function podFixed(): StringOrFloatMap
    {
        return $this->podFixed;
    }

    public function setPodFixed(StringOrFloatMap $podFixed): self
    {
        $this->podFixed = $podFixed;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'podFixed' => $this->podFixed,
        ]);
    }
}
