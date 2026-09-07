<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1alpha2;

use ArrayObject;
use JsonSerializable;

/**
 * PodGroupSchedulingPolicy defines the scheduling configuration for a PodGroup.
 * Exactly one policy must be set.
 */
class PodGroupSchedulingPolicy implements JsonSerializable
{
    /**
     * Basic specifies that the pods in this group should be scheduled using standard
     * Kubernetes scheduling behavior.
     */
    private BasicSchedulingPolicy|null $basic = null;

    /**
     * Gang specifies that the pods in this group should be scheduled using
     * all-or-nothing semantics.
     */
    private GangSchedulingPolicy|null $gang = null;

    public function __construct()
    {
    }

    public function basic(): BasicSchedulingPolicy
    {
        return $this->basic ??= new BasicSchedulingPolicy();
    }

    public function getBasic(): BasicSchedulingPolicy|null
    {
        return $this->basic;
    }

    public function getGang(): GangSchedulingPolicy|null
    {
        return $this->gang;
    }

    public function setBasic(BasicSchedulingPolicy $basic): self
    {
        $this->basic = $basic;

        return $this;
    }

    public function setGang(GangSchedulingPolicy $gang): self
    {
        $this->gang = $gang;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'basic' => $this->basic,
            'gang' => $this->gang,
        ]);
    }
}
