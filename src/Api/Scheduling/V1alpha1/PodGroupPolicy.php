<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1alpha1;

use JsonSerializable;

/**
 * PodGroupPolicy defines the scheduling configuration for a PodGroup.
 */
class PodGroupPolicy implements JsonSerializable
{
    /**
     * Basic specifies that the pods in this group should be scheduled using standard
     * Kubernetes scheduling behavior.
     */
    private BasicSchedulingPolicy $basic;

    /**
     * Gang specifies that the pods in this group should be scheduled using
     * all-or-nothing semantics.
     */
    private GangSchedulingPolicy|null $gang = null;

    public function __construct()
    {
        $this->basic = new BasicSchedulingPolicy();
    }

    public function basic(): BasicSchedulingPolicy
    {
        return $this->basic;
    }

    public function getGang(): GangSchedulingPolicy|null
    {
        return $this->gang;
    }

    public function setGang(GangSchedulingPolicy $gang): self
    {
        $this->gang = $gang;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'basic' => $this->basic,
            'gang' => $this->gang,
        ];
    }
}
