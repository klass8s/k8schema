<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1beta1;

use ArrayObject;
use JsonSerializable;

/**
 * PodGroupTemplate represents a template for a set of pods with a scheduling
 * policy.
 */
class PodGroupTemplate implements JsonSerializable
{
    /**
     * disruptionMode defines the mode in which a given PodGroup can be disrupted. One
     * of Single, All. This field is immutable.
     */
    private DisruptionMode|null $disruptionMode = null;

    /**
     * name is a unique identifier for the PodGroupTemplate within the Workload. It
     * must be a DNS label. This field is immutable.
     */
    private string $name;

    /**
     * preemptionPolicy is the Policy for preempting pods/podgroups with lower
     * priority. One of Never, PreemptLowerPriority. This field is immutable. This
     * field is available only when the PodGroupPreemptionPolicy feature gate is
     * enabled.
     */
    private string|null $preemptionPolicy = null;

    /**
     * priority is the value of priority of pod groups created from this template.
     * Various system components use this field to find the priority of the pod group.
     * The higher the value, the higher the priority. This field is immutable.
     */
    private int|null $priority = null;

    /**
     * priorityClassName indicates the priority that should be considered when
     * scheduling a pod group created from this template. This field is immutable.
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
     * for this PodGroupTemplate. This field is only available when the
     * TopologyAwareWorkloadScheduling feature gate is enabled. This field is
     * immutable.
     */
    private PodGroupSchedulingConstraints|null $schedulingConstraints = null;

    /**
     * schedulingPolicy defines the scheduling policy for this PodGroupTemplate.
     */
    private PodGroupSchedulingPolicy $schedulingPolicy;

    public function __construct(string $name)
    {
        $this->name = $name;
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

    public function getName(): string
    {
        return $this->name;
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

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'disruptionMode' => $this->disruptionMode,
            'name' => $this->name,
            'preemptionPolicy' => $this->preemptionPolicy,
            'priority' => $this->priority,
            'priorityClassName' => $this->priorityClassName,
            'resourceClaims' => $this->resourceClaims,
            'schedulingConstraints' => $this->schedulingConstraints,
            'schedulingPolicy' => $this->schedulingPolicy,
        ]);
    }
}
