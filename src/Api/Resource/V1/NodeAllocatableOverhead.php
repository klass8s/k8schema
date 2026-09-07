<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1;

use ArrayObject;
use JsonSerializable;

/**
 * NodeAllocatableOverhead defines auxiliary resource overheads incurred when
 * allocating a device. Overheads can be specified as a fixed cost per pod
 * referencing the claim, a variable cost per container reference, or both. Kubelet
 * accounts for this overhead by adding it to both the pod-level and
 * container-level cgroups of referencing containers.
 */
class NodeAllocatableOverhead implements JsonSerializable
{
    /**
     * PerContainer is applied per container reference to the claim. This models
     * overhead scaling linearly with the number of containers actively using the
     * device. When both PerPod and PerContainer are specified, the total overhead
     * allocated for each pod referencing the claim is computed as: Quantity = PerPod +
     * (PerContainer * NumReferences) Kubelet accounts for this overhead in cgroups: -
     * Pod-level cgroup (requests and limits): Kubelet adds PerPod + (PerContainer *
     * NumReferences). - Container-level cgroup (limits only): Kubelet adds PerPod +
     * PerContainer for each referencing container. This allows any single container to
     * access the pod-level overhead, while the parent cgroup caps the total usage to
     * account for PerPod exactly once.
     */
    private string|float|null $perContainer = null;

    /**
     * PerPod is overhead applied once per pod referencing the claim on this node. This
     * is a flat overhead incurred for every pod referencing the claim.
     */
    private string|float|null $perPod = null;

    public function __construct()
    {
    }

    public function getPerContainer(): string|float|null
    {
        return $this->perContainer;
    }

    public function getPerPod(): string|float|null
    {
        return $this->perPod;
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
            'perContainer' => $this->perContainer,
            'perPod' => $this->perPod,
        ]);
    }
}
