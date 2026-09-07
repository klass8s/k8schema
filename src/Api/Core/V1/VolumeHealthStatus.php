<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\DateTimeInterface;

/**
 * VolumeHealthStatus contains health information for a volume reported by the CSI
 * controller plugin.
 */
class VolumeHealthStatus implements JsonSerializable
{
    /**
     * conditions is the set of adverse conditions reported by the CSI controller
     * plugin. An empty list means no adverse condition. At most 16 conditions may be
     * reported.
     */
    private VolumeHealthConditionList $healthConditions;

    /**
     * lastTransitionTime is when the current set of conditions first appeared.
     */
    private DateTimeInterface|null $lastTransitionTime = null;

    public function __construct()
    {
        $this->healthConditions = new VolumeHealthConditionList();
    }

    public function getLastTransitionTime(): DateTimeInterface|null
    {
        return $this->lastTransitionTime;
    }

    public function healthConditions(): VolumeHealthConditionList
    {
        return $this->healthConditions;
    }

    public function setHealthConditions(VolumeHealthConditionList $healthConditions): self
    {
        $this->healthConditions = $healthConditions;

        return $this;
    }

    public function setLastTransitionTime(DateTimeInterface $lastTransitionTime): self
    {
        $this->lastTransitionTime = $lastTransitionTime;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'healthConditions' => $this->healthConditions,
            'lastTransitionTime' => $this->lastTransitionTime,
        ]);
    }
}
