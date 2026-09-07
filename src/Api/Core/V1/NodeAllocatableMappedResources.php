<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * NodeAllocatableMappedResources describes mapped node allocatable resource
 * allocations.
 */
class NodeAllocatableMappedResources implements JsonSerializable
{
    /**
     * Name is the name of the resource (e.g., cpu, memory).
     */
    private string $name;

    /**
     * Quantity is the total node allocatable resource capacity allocated for the
     * claim. This claim's allocated devices is shared by all the containers
     * referencing the claim. Kubelet adds this value to both requests and limits at
     * the pod-level cgroup, and to limits at the container-level cgroup for each
     * container referencing the claim.
     */
    private string|float $quantity;

    public function __construct(string $name, string|float $quantity)
    {
        $this->name = $name;
        $this->quantity = $quantity;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getQuantity(): string|float
    {
        return $this->quantity;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setQuantity(string|float $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'name' => $this->name,
            'quantity' => $this->quantity,
        ]);
    }
}
