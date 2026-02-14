<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1alpha1;

use ArrayObject;
use JsonSerializable;

/**
 * GangSchedulingPolicy defines the parameters for gang scheduling.
 */
class GangSchedulingPolicy implements JsonSerializable
{
    /**
     * MinCount is the minimum number of pods that must be schedulable or scheduled at
     * the same time for the scheduler to admit the entire group. It must be a positive
     * integer.
     */
    private int $minCount;

    public function __construct(int $minCount)
    {
        $this->minCount = $minCount;
    }

    public function getMinCount(): int
    {
        return $this->minCount;
    }

    public function setMinCount(int $minCount): self
    {
        $this->minCount = $minCount;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'minCount' => $this->minCount,
        ]);
    }
}
