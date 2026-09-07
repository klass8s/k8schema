<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * NodeAllocatableOverheadResources describes auxiliary overhead resource
 * allocations.
 */
class NodeAllocatableOverheadResources implements JsonSerializable
{
    /**
     * Name is the name of the resource (e.g., cpu, memory).
     */
    private string $name;

    /**
     * PerContainer is the variable overhead quantity applied for each container
     * referencing the claim. The container references are recorded in
     * `nodeAllocatableResourceClaimStatuses.containers`. The total overhead quantity
     * allocated for the claim is computed as: Quantity = PerPod + (PerContainer *
     * NumReferences) Kubelet accounts for this overhead in cgroups: - Pod-level cgroup
     * (requests and limits): Kubelet adds PerPod + (PerContainer * NumReferences). -
     * Container-level cgroup (limits only): Kubelet adds PerPod + PerContainer for
     * each referencing container. This allows any single container to access the
     * pod-level overhead, while the parent cgroup caps the total usage to account for
     * PerPod exactly once. At least one of PerPod or PerContainer must be specified.
     * Specifying neither is an invalid configuration.
     */
    private string|float|null $perContainer = null;

    /**
     * PerPod is the flat overhead quantity allocated per pod. Adding to each container
     * limit allows individual containers to utilize the overhead, while the parent
     * pod-level cgroup limit caps the total usage at the pod boundary where the
     * overhead is accounted for exactly once. At least one of PerPod or PerContainer
     * must be specified. Specifying neither is an invalid configuration.
     */
    private string|float|null $perPod = null;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPerContainer(): string|float|null
    {
        return $this->perContainer;
    }

    public function getPerPod(): string|float|null
    {
        return $this->perPod;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setPerContainer(string|float $perContainer): self
    {
        $this->perContainer = $perContainer;

        return $this;
    }

    public function setPerPod(string|float $perPod): self
    {
        $this->perPod = $perPod;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'name' => $this->name,
            'perContainer' => $this->perContainer,
            'perPod' => $this->perPod,
        ]);
    }
}
