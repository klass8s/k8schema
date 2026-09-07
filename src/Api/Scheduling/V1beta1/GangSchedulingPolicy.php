<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1beta1;

use ArrayObject;
use JsonSerializable;

/**
 * GangSchedulingPolicy defines the parameters for gang scheduling.
 */
class GangSchedulingPolicy implements JsonSerializable
{
    /**
     * minCount is the minimum number of pods that must be schedulable or scheduled at
     * the same time for the scheduler to admit the entire group. It must be a positive
     * integer. This field is mutable to support workload scaling.
     *
     * Note that the scheduler operates on an eventually consistent model. Updates to
     * minCount may not be immediately reflected in scheduling decisions due to
     * propagation delays. If minCount is updated while a scheduling cycle is in
     * progress for that group, the new value may not take effect until the next cycle.
     * Moreover, minCount is only enforced during scheduling, meaning that
     * modifications to this field do not affect already-scheduled pods, applying only
     * to those evaluated in future cycles.
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
