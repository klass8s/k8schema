<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1alpha3;

use ArrayObject;
use JsonSerializable;

/**
 * AllCompositeDisruptionMode means that children of a CompositePodGroup can only
 * be disrupted or preempted together.
 */
class AllCompositeDisruptionMode implements JsonSerializable
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
