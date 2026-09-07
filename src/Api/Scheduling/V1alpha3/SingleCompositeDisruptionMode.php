<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1alpha3;

use ArrayObject;
use JsonSerializable;

/**
 * SingleCompositeDisruptionMode means that individual children of a
 * CompositePodGroup can be disrupted or preempted independently.
 */
class SingleCompositeDisruptionMode implements JsonSerializable
{
    public function __construct()
    {
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
        ]);
    }
}
