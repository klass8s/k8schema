<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1alpha2;

use ArrayObject;
use JsonSerializable;

/**
 * PodGroupTemplate represents a template for a set of pods with a scheduling
 * policy.
 */
class PodGroupTemplate implements JsonSerializable
{
    /**
     * DisruptionMode defines the mode in which a given PodGroup can be disrupted. One
     * of Pod, PodGroup. This field is available only when the WorkloadAwarePreemption
     * feature gate is enabled.
     */
    private string|null $disruptionMode = null;

    /**
     * Name is a unique identifier for the PodGroupTemplate within the Workload. It
     * must be a DNS label. This field is immutable.
     */
    private string $name;

    /**
     * Priority is the value of priority of pod groups created from this template.
     * Various system components use this field to find the priority of the pod group.
     * When Priority Admission Controller is enabled, it prevents users from setting
     * this field. The admission controller populates this field from
     * PriorityClassName. The higher the value, the higher the priority. This field is
     * available only when the WorkloadAwarePreemption feature gate is enabled.
     */
    private int|null $priority = null;

    /**
     * PriorityClassName indicates the priority that should be considered when
     * scheduling a pod group created from this template. If no priority class is
     * specified, admission control can set this to the global default priority class
     * if it exists. Otherwise, pod groups created from this template will have the
     * priority set to zero. This field is available only when the
     * WorkloadAwarePreemption feature gate is enabled.
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
     * for this PodGroupTemplate. This field is only available when the
     * TopologyAwareWorkloadScheduling feature gate is enabled.
     */
    private PodGroupSchedulingConstraints|null $schedulingConstraints = null;

    /**
     * SchedulingPolicy defines the scheduling policy for this PodGroupTemplate.
     */
    private PodGroupSchedulingPolicy $schedulingPolicy;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->resourceClaims = new PodGroupResourceClaimList();
        $this->schedulingPolicy = new PodGroupSchedulingPolicy();
    }

    public function getDisruptionMode(): string|null
    {
        return $this->disruptionMode;
    }

    public function getName(): string
    {
        return $this->name;
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

    public function setName(string $name): self
    {
        $this->name = $name;

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
            'name' => $this->name,
            'priority' => $this->priority,
            'priorityClassName' => $this->priorityClassName,
            'resourceClaims' => $this->resourceClaims,
            'schedulingConstraints' => $this->schedulingConstraints,
            'schedulingPolicy' => $this->schedulingPolicy,
        ]);
    }
}
