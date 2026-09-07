<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1beta1;

use ArrayObject;
use JsonSerializable;

/**
 * PodGroupSpec defines the desired state of a PodGroup.
 */
class PodGroupSpec implements JsonSerializable
{
    /**
     * disruptionMode defines the mode in which a given PodGroup can be disrupted.
     * Controllers are expected to fill this field by copying it from a
     * PodGroupTemplate. One of Single, All. Defaults to Single if unset. This field is
     * immutable.
     */
    private DisruptionMode|null $disruptionMode = null;

    /**
     * parentCompositePodGroupName contains the name of the parent composite pod group
     * within the same namespace as this pod group. If it's nil, then this pod group is
     * a root of a workload's hierarchy. This field is used only when the
     * CompositePodGroup feature gate is enabled. This field is immutable.
     */
    private string|null $parentCompositePodGroupName = null;

    /**
     * preemptionPolicy is the Policy for preempting pods/podgroups with lower
     * priority. One of Never, PreemptLowerPriority. Defaults to PreemptLowerPriority
     * if unset. When Priority Admission Controller is enabled, it populates this field
     * from PriorityClassName, and defaults to PreemptLowerPriority if value is unset
     * in PriorityClass. This field is immutable. This field is available only when the
     * PodGroupPreemptionPolicy feature gate is enabled.
     */
    private string|null $preemptionPolicy = null;

    /**
     * priority is the value of priority of this pod group. Various system components
     * use this field to find the priority of the pod group. When Priority Admission
     * Controller is enabled, it prevents users from setting this field. The admission
     * controller populates this field from PriorityClassName. The higher the value,
     * the higher the priority. This field is immutable.
     */
    private int|null $priority = null;

    /**
     * priorityClassName defines the priority that should be considered when scheduling
     * this pod group. Controllers are expected to fill this field by copying it from a
     * PodGroupTemplate. Otherwise, it is validated and resolved similarly to the
     * PriorityClassName on PodGroupTemplate (i.e. if no priority class is specified,
     * admission control can set this to the global default priority class if it
     * exists. Otherwise, the pod group's priority will be zero). This field is
     * immutable.
     */
    private string|null $priorityClassName = null;

    /**
     * resourceClaims defines which ResourceClaims may be shared among Pods in the
     * group. Pods consume the devices allocated to a PodGroup's claim by defining a
     * claim in its own Spec.ResourceClaims that matches the PodGroup's claim exactly.
     * The claim must have the same name and refer to the same ResourceClaim or
     * ResourceClaimTemplate.
     *
     * This is a beta-level field and requires that the DRAWorkloadResourceClaims
     * feature gate is enabled.
     *
     * This field is immutable.
     */
    private PodGroupResourceClaimList $resourceClaims;

    /**
     * schedulingConstraints defines optional scheduling constraints (e.g. topology)
     * for this PodGroup. Controllers are expected to fill this field by copying it
     * from a PodGroupTemplate. This field is immutable. This field is only available
     * when the TopologyAwareWorkloadScheduling feature gate is enabled.
     */
    private PodGroupSchedulingConstraints|null $schedulingConstraints = null;

    /**
     * schedulingPolicy defines the scheduling policy for this instance of the
     * PodGroup. Controllers are expected to fill this field by copying it from a
     * PodGroupTemplate.
     */
    private PodGroupSchedulingPolicy $schedulingPolicy;

    /**
     * workloadRef references an optional PodGroup template within the Workload object
     * that was used to create the PodGroup. This field is immutable.
     */
    private WorkloadReference|null $workloadRef = null;

    public function __construct()
    {
        $this->resourceClaims = new PodGroupResourceClaimList();
        $this->schedulingPolicy = new PodGroupSchedulingPolicy();
    }

    public function disruptionMode(): DisruptionMode
    {
        return $this->disruptionMode ??= new DisruptionMode();
    }

    public function getDisruptionMode(): DisruptionMode|null
    {
        return $this->disruptionMode;
    }

    public function getParentCompositePodGroupName(): string|null
    {
        return $this->parentCompositePodGroupName;
    }

    public function getPreemptionPolicy(): string|null
    {
        return $this->preemptionPolicy;
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

    public function getWorkloadRef(): WorkloadReference|null
    {
        return $this->workloadRef;
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

    public function setDisruptionMode(DisruptionMode $disruptionMode): self
    {
        $this->disruptionMode = $disruptionMode;

        return $this;
    }

    public function setParentCompositePodGroupName(string $parentCompositePodGroupName): self
    {
        $this->parentCompositePodGroupName = $parentCompositePodGroupName;

        return $this;
    }

    public function setPreemptionPolicy(string $preemptionPolicy): self
    {
        $this->preemptionPolicy = $preemptionPolicy;

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

    public function setWorkloadRef(WorkloadReference $workloadRef): self
    {
        $this->workloadRef = $workloadRef;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'disruptionMode' => $this->disruptionMode,
            'parentCompositePodGroupName' => $this->parentCompositePodGroupName,
            'preemptionPolicy' => $this->preemptionPolicy,
            'priority' => $this->priority,
            'priorityClassName' => $this->priorityClassName,
            'resourceClaims' => $this->resourceClaims,
            'schedulingConstraints' => $this->schedulingConstraints,
            'schedulingPolicy' => $this->schedulingPolicy,
            'workloadRef' => $this->workloadRef,
        ]);
    }
}
