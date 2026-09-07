<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1alpha3;

use ArrayObject;
use JsonSerializable;

/**
 * WorkloadPodGroupSchedulingPolicy defines the scheduling policy for a group of
 * pods managed by a workload controller. Exactly one policy must be set.
 */
class WorkloadPodGroupSchedulingPolicy implements JsonSerializable
{
    /**
     * basic specifies that standard, pod-by-pod Kubernetes scheduling behavior should
     * be used.
     */
    private WorkloadPodGroupBasicSchedulingPolicy|null $basic = null;

    /**
     * gang specifies all-or-nothing scheduling semantics.
     */
    private WorkloadPodGroupGangSchedulingPolicy|null $gang = null;

    public function __construct()
    {
    }

    public function basic(): WorkloadPodGroupBasicSchedulingPolicy
    {
        return $this->basic ??= new WorkloadPodGroupBasicSchedulingPolicy();
    }

    public function gang(): WorkloadPodGroupGangSchedulingPolicy
    {
        return $this->gang ??= new WorkloadPodGroupGangSchedulingPolicy();
    }

    public function getBasic(): WorkloadPodGroupBasicSchedulingPolicy|null
    {
        return $this->basic;
    }

    public function getGang(): WorkloadPodGroupGangSchedulingPolicy|null
    {
        return $this->gang;
    }

    public function setBasic(WorkloadPodGroupBasicSchedulingPolicy $basic): self
    {
        $this->basic = $basic;

        return $this;
    }

    public function setGang(WorkloadPodGroupGangSchedulingPolicy $gang): self
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
