<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1beta1;

use ArrayObject;
use JsonSerializable;

/**
 * CompositePodGroupTemplate represents a template for a CompositePodGroup with a
 * scheduling policy.
 */
class CompositePodGroupTemplate implements JsonSerializable
{
    /**
     * compositePodGroupTemplates is the list of templates for children
     * CompositePodGroups. The maximum number of templates is 8. At least one entry in
     * CompositePodGroupTemplates or PodGroupTemplates must be set.
     */
    private CompositePodGroupTemplateList $compositePodGroupTemplates;

    /**
     * disruptionMode defines the mode in which a given CompositePodGroup can be
     * disrupted. One of Single, All. This field is immutable.
     */
    private CompositeDisruptionMode|null $disruptionMode = null;

    /**
     * name is a unique identifier for the CompositePodGroupTemplate within the
     * Workload. It must be a DNS label. This field is required.
     */
    private string $name;

    /**
     * podGroupTemplates is the list of templates for children PodGroups. The maximum
     * number of templates is 8. At least one entry in CompositePodGroupTemplates or
     * PodGroupTemplates must be set.
     */
    private PodGroupTemplateList $podGroupTemplates;

    /**
     * preemptionPolicy is the Policy for preempting pods/podgroups with lower
     * priority. One of Never, PreemptLowerPriority. This field is immutable. This
     * field is available only when the PodGroupPreemptionPolicy feature gate is
     * enabled.
     */
    private string|null $preemptionPolicy = null;

    /**
     * priority is the value of priority of composite pod groups created from this
     * template. Various system components use this field to find the priority of the
     * composite pod group. When Priority Admission Controller is enabled, it prevents
     * users from setting this field. The admission controller populates this field
     * from PriorityClassName. The higher the value, the higher the priority. This
     * field is immutable.
     */
    private int|null $priority = null;

    /**
     * priorityClassName indicates the priority that should be considered when
     * scheduling a composite pod group created from this template. If no priority
     * class is specified, admission control can set this to the global default
     * priority class if it exists. Otherwise, composite pod groups created from this
     * template will have the priority set to zero. This field is immutable.
     */
    private string|null $priorityClassName = null;

    /**
     * schedulingConstraints defines optional scheduling constraints (e.g. topology)
     * for this CompositePodGroupTemplate. This field is immutable.
     */
    private CompositePodGroupSchedulingConstraints|null $schedulingConstraints = null;

    /**
     * schedulingPolicy defines the scheduling policy for this template.
     */
    private CompositePodGroupSchedulingPolicy $schedulingPolicy;

    public function __construct(string $name)
    {
        $this->compositePodGroupTemplates = new CompositePodGroupTemplateList();
        $this->name = $name;
        $this->podGroupTemplates = new PodGroupTemplateList();
        $this->schedulingPolicy = new CompositePodGroupSchedulingPolicy();
    }

    public function compositePodGroupTemplates(): CompositePodGroupTemplateList
    {
        return $this->compositePodGroupTemplates;
    }

    public function disruptionMode(): CompositeDisruptionMode
    {
        return $this->disruptionMode ??= new CompositeDisruptionMode();
    }

    public function getDisruptionMode(): CompositeDisruptionMode|null
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

    public function getSchedulingConstraints(): CompositePodGroupSchedulingConstraints|null
    {
        return $this->schedulingConstraints;
    }

    public function podGroupTemplates(): PodGroupTemplateList
    {
        return $this->podGroupTemplates;
    }

    public function schedulingConstraints(): CompositePodGroupSchedulingConstraints
    {
        return $this->schedulingConstraints ??= new CompositePodGroupSchedulingConstraints();
    }

    public function schedulingPolicy(): CompositePodGroupSchedulingPolicy
    {
        return $this->schedulingPolicy;
    }

    public function setCompositePodGroupTemplates(CompositePodGroupTemplateList $compositePodGroupTemplates): self
    {
        $this->compositePodGroupTemplates = $compositePodGroupTemplates;

        return $this;
    }

    public function setDisruptionMode(CompositeDisruptionMode $disruptionMode): self
    {
        $this->disruptionMode = $disruptionMode;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setPodGroupTemplates(PodGroupTemplateList $podGroupTemplates): self
    {
        $this->podGroupTemplates = $podGroupTemplates;

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

    public function setSchedulingConstraints(CompositePodGroupSchedulingConstraints $schedulingConstraints): self
    {
        $this->schedulingConstraints = $schedulingConstraints;

        return $this;
    }

    public function setSchedulingPolicy(CompositePodGroupSchedulingPolicy $schedulingPolicy): self
    {
        $this->schedulingPolicy = $schedulingPolicy;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'compositePodGroupTemplates' => $this->compositePodGroupTemplates,
            'disruptionMode' => $this->disruptionMode,
            'name' => $this->name,
            'podGroupTemplates' => $this->podGroupTemplates,
            'preemptionPolicy' => $this->preemptionPolicy,
            'priority' => $this->priority,
            'priorityClassName' => $this->priorityClassName,
            'schedulingConstraints' => $this->schedulingConstraints,
            'schedulingPolicy' => $this->schedulingPolicy,
        ]);
    }
}
