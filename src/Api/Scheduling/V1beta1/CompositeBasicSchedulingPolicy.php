<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1beta1;

use ArrayObject;
use JsonSerializable;

/**
 * CompositeBasicSchedulingPolicy indicates that the groups belonging to the
 * composite group should be scheduled independently.
 */
class CompositeBasicSchedulingPolicy implements JsonSerializable
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
