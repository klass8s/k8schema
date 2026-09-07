<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1alpha3;

use ArrayObject;
use JsonSerializable;

/**
 * WorkloadPodGroupGangSchedulingPolicy defines the parameters for gang
 * (all-or-nothing) scheduling.
 */
class WorkloadPodGroupGangSchedulingPolicy implements JsonSerializable
{
    /**
     * minCount is the minimum number of pods that must be scheduled at the same time
     * for the scheduler to admit the entire group. This field is optional. If it is
     * not specified, the controller should inject a context-specific sane default
     * (e.g., parallelism for a Job). If set, it must be a positive integer.
     */
    private int|null $minCount = null;

    public function __construct()
    {
    }

    public function getMinCount(): int|null
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
