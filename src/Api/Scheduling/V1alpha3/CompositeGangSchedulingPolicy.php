<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1alpha3;

use ArrayObject;
use JsonSerializable;

/**
 * CompositeGangSchedulingPolicy indicates that the groups belonging to the
 * composite group should be scheduled using all-or-nothing semantics.
 */
class CompositeGangSchedulingPolicy implements JsonSerializable
{
    /**
     * minGroupCount is the minimum number of child groups that must be schedulable or
     * scheduled at the same time for the scheduler to admit the entire group. It must
     * be a positive integer.
     */
    private int $minGroupCount;

    public function __construct(int $minGroupCount)
    {
        $this->minGroupCount = $minGroupCount;
    }

    public function getMinGroupCount(): int
    {
        return $this->minGroupCount;
    }

    public function setMinGroupCount(int $minGroupCount): self
    {
        $this->minGroupCount = $minGroupCount;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'minGroupCount' => $this->minGroupCount,
        ]);
    }
}
