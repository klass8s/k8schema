<?php

declare(strict_types=1);

namespace K8Schema\Api\Batch\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Api\Scheduling\V1alpha3\WorkloadPodGroupDisruptionMode;
use K8Schema\Api\Scheduling\V1alpha3\WorkloadPodGroupResourceClaimList;
use K8Schema\Api\Scheduling\V1alpha3\WorkloadPodGroupSchedulingConstraints;
use K8Schema\Api\Scheduling\V1alpha3\WorkloadPodGroupSchedulingPolicy;

/**
 * JobSchedulingConfiguration composes the reusable workload-aware scheduling
 * building blocks.
 */
class JobSchedulingConfiguration implements JsonSerializable
{
    /**
     * DisruptionMode defines the mode in which the Job's pods can be disrupted. One of
     * Single, All. This field is immutable after creation: it may not be added or
     * removed, and the selected mode may not be changed.
     */
    private WorkloadPodGroupDisruptionMode|null $disruptionMode = null;

    /**
     * ResourceClaims defines which ResourceClaims may be shared among Pods in the Job.
     * Pods consume the devices allocated to a PodGroup's claim by defining a claim in
     * its own Spec.ResourceClaims that matches the PodGroup's claim exactly. The claim
     * must have the same name and refer to the same ResourceClaim or
     * ResourceClaimTemplate. At most 4 claims may be set, matching the limit on the
     * resulting PodGroup. This list is immutable after creation: entries may neither
     * be added, removed, nor modified.
     */
    private WorkloadPodGroupResourceClaimList $resourceClaims;

    /**
     * SchedulingConstraints defines scheduling constraints (e.g. topology) for the
     * Job's pods. This field is immutable after creation.
     */
    private WorkloadPodGroupSchedulingConstraints|null $schedulingConstraints = null;

    /**
     * SchedulingPolicy defines the scheduling policy for this Job. Exactly one of
     * Basic or Gang must be set. This field is immutable after creation: the policy
     * may not be added or removed. The policy variant (basic/gang) is frozen by
     * hand-written validation; only schedulingPolicy.gang.minCount may be changed.
     */
    private WorkloadPodGroupSchedulingPolicy|null $schedulingPolicy = null;

    public function __construct()
    {
        $this->resourceClaims = new WorkloadPodGroupResourceClaimList();
    }

    public function disruptionMode(): WorkloadPodGroupDisruptionMode
    {
        return $this->disruptionMode ??= new WorkloadPodGroupDisruptionMode();
    }

    public function getDisruptionMode(): WorkloadPodGroupDisruptionMode|null
    {
        return $this->disruptionMode;
    }

    public function getSchedulingConstraints(): WorkloadPodGroupSchedulingConstraints|null
    {
        return $this->schedulingConstraints;
    }

    public function getSchedulingPolicy(): WorkloadPodGroupSchedulingPolicy|null
    {
        return $this->schedulingPolicy;
    }

    public function resourceClaims(): WorkloadPodGroupResourceClaimList
    {
        return $this->resourceClaims;
    }

    public function schedulingConstraints(): WorkloadPodGroupSchedulingConstraints
    {
        return $this->schedulingConstraints ??= new WorkloadPodGroupSchedulingConstraints();
    }

    public function schedulingPolicy(): WorkloadPodGroupSchedulingPolicy
    {
        return $this->schedulingPolicy ??= new WorkloadPodGroupSchedulingPolicy();
    }

    public function setDisruptionMode(WorkloadPodGroupDisruptionMode $disruptionMode): self
    {
        $this->disruptionMode = $disruptionMode;

        return $this;
    }

    public function setResourceClaims(WorkloadPodGroupResourceClaimList $resourceClaims): self
    {
        $this->resourceClaims = $resourceClaims;

        return $this;
    }

    public function setSchedulingConstraints(WorkloadPodGroupSchedulingConstraints $schedulingConstraints): self
    {
        $this->schedulingConstraints = $schedulingConstraints;

        return $this;
    }

    public function setSchedulingPolicy(WorkloadPodGroupSchedulingPolicy $schedulingPolicy): self
    {
        $this->schedulingPolicy = $schedulingPolicy;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'disruptionMode' => $this->disruptionMode,
            'resourceClaims' => $this->resourceClaims,
            'schedulingConstraints' => $this->schedulingConstraints,
            'schedulingPolicy' => $this->schedulingPolicy,
        ]);
    }
}
