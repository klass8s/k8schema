<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\DateTimeInterface;

/**
 * PodVolumeHealth contains health information for a volume used by a pod, reported
 * by the CSI node plugin via the kubelet.
 */
class PodVolumeHealth implements JsonSerializable
{
    /**
     * conditions is the set of adverse conditions reported by the CSI node plugin for
     * this volume on this node. At most 16 conditions may be reported.
     */
    private VolumeHealthConditionList $healthConditions;

    /**
     * lastTransitionTime is when the current set of conditions first appeared.
     */
    private DateTimeInterface|null $lastTransitionTime = null;

    /**
     * name matches an entry in pod.spec.volumes.
     */
    private string $name;

    public function __construct(string $name)
    {
        $this->healthConditions = new VolumeHealthConditionList();
        $this->name = $name;
    }

    public function getLastTransitionTime(): DateTimeInterface|null
    {
        return $this->lastTransitionTime;
    }

    public function getName(): string
    {
        return $this->name;
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

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'healthConditions' => $this->healthConditions,
            'lastTransitionTime' => $this->lastTransitionTime,
            'name' => $this->name,
        ]);
    }
}
