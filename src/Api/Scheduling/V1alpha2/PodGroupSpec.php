<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1alpha2;

use ArrayObject;
use JsonSerializable;

/**
 * PodGroupSpec defines the desired state of a PodGroup.
 */
class PodGroupSpec implements JsonSerializable
{
    /**
     * DisruptionMode defines the mode in which a given PodGroup can be disrupted.
     * Controllers are expected to fill this field by copying it from a
     * PodGroupTemplate. One of Pod, PodGroup. Defaults to Pod if unset. This field is
     * immutable. This field is available only when the WorkloadAwarePreemption feature
     * gate is enabled.
     */
    private string|null $disruptionMode = null;

    /**
     * PodGroupTemplateRef references an optional PodGroup template within other object
     * (e.g. Workload) that was used to create the PodGroup. This field is immutable.
     */
    private PodGroupTemplateReference|null $podGroupTemplateRef = null;

    /**
     * Priority is the value of priority of this pod group. Various system components
     * use this field to find the priority of the pod group. When Priority Admission
     * Controller is enabled, it prevents users from setting this field. The admission
     * controller populates this field from PriorityClassName. The higher the value,
     * the higher the priority. This field is immutable. This field is available only
     * when the WorkloadAwarePreemption feature gate is enabled.
     */
    private int|null $priority = null;

    /**
     * PriorityClassName defines the priority that should be considered when scheduling
     * this pod group. Controllers are expected to fill this field by copying it from a
     * PodGroupTemplate. Otherwise, it is validated and resolved similarly to the
     * PriorityClassName on PodGroupTemplate (i.e. if no priority class is specified,
     * admission control can set this to the global default priority class if it
     * exists. Otherwise, the pod group's priority will be zero). This field is
     * immutable. This field is available only when the WorkloadAwarePreemption feature
     * gate is enabled.
     */
    private string|null $priorityClassName = null;

    /**
     * ResourceClaims defines which ResourceClaims may be shared among Pods in the
     * group. Pods consume the devices allocated to a PodGroup's claim by defining a
     * claim in its own Spec.ResourceClaims that matches the PodGroup's claim exactly.
     * The claim must have the same name and refer to the same ResourceClaim or
     * ResourceClaimTemplate.
     *
     * This is an alpha-level field and requires that the DRAWorkloadResourceClaims
     * feature gate is enabled.
     *
     * This field is immutable.
     */
    private PodGroupResourceClaimList $resourceClaims;

    /**
     * SchedulingConstraints defines optional scheduling constraints (e.g. topology)
     * for this PodGroup. Controllers are expected to fill this field by copying it
     * from a PodGroupTemplate. This field is immutable. This field is only available
     * when the TopologyAwareWorkloadScheduling feature gate is enabled.
     */
    private PodGroupSchedulingConstraints|null $schedulingConstraints = null;

    /**
     * SchedulingPolicy defines the scheduling policy for this instance of the
     * PodGroup. Controllers are expected to fill this field by copying it from a
     * PodGroupTemplate. This field is immutable.
     */
    private PodGroupSchedulingPolicy $schedulingPolicy;

    public function __construct()
    {
        $this->resourceClaims = new PodGroupResourceClaimList();
        $this->schedulingPolicy = new PodGroupSchedulingPolicy();
    }

    public function getDisruptionMode(): string|null
    {
        return $this->disruptionMode;
    }

    public function getPodGroupTemplateRef(): PodGroupTemplateReference|null
    {
        return $this->podGroupTemplateRef;
    }

    public function getPriority(): int|null
    {
        return $this->priority;
    }

    public function getPriorityClassName(): string|null
    {
        return $this->priorityClassName;
    }

    public function getSchedulingConstraints(): PodGroupSchedulingConstraints|null
    {
        return $this->schedulingConstraints;
    }

    public function podGroupTemplateRef(): PodGroupTemplateReference
    {
        return $this->podGroupTemplateRef ??= new PodGroupTemplateReference();
    }

    public function resourceClaims(): PodGroupResourceClaimList
    {
        return $this->resourceClaims;
    }

    public function schedulingConstraints(): PodGroupSchedulingConstraints
    {
        return $this->schedulingConstraints ??= new PodGroupSchedulingConstraints();
    }

    public function schedulingPolicy(): PodGroupSchedulingPolicy
    {
        return $this->schedulingPolicy;
    }

    public function setDisruptionMode(string $disruptionMode): self
    {
        $this->disruptionMode = $disruptionMode;

        return $this;
    }

    public function setPodGroupTemplateRef(PodGroupTemplateReference $podGroupTemplateRef): self
    {
        $this->podGroupTemplateRef = $podGroupTemplateRef;

        return $this;
    }

    public function setPriority(int $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    public function setPriorityClassName(string $priorityClassName): self
    {
        $this->priorityClassName = $priorityClassName;

        return $this;
    }

    public function setResourceClaims(PodGroupResourceClaimList $resourceClaims): self
    {
        $this->resourceClaims = $resourceClaims;

        return $this;
    }

    public function setSchedulingConstraints(PodGroupSchedulingConstraints $schedulingConstraints): self
    {
        $this->schedulingConstraints = $schedulingConstraints;

        return $this;
    }

    public function setSchedulingPolicy(PodGroupSchedulingPolicy $schedulingPolicy): self
    {
        $this->schedulingPolicy = $schedulingPolicy;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'disruptionMode' => $this->disruptionMode,
            'podGroupTemplateRef' => $this->podGroupTemplateRef,
            'priority' => $this->priority,
            'priorityClassName' => $this->priorityClassName,
            'resourceClaims' => $this->resourceClaims,
            'schedulingConstraints' => $this->schedulingConstraints,
            'schedulingPolicy' => $this->schedulingPolicy,
        ]);
    }
}
