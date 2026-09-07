<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1;

use ArrayObject;
use JsonSerializable;

/**
 * NodeAllocatableResource defines the translation between the DRA device/capacity
 * units requested to the corresponding quantity of the node allocatable resource.
 * At least one of Mapping or Overhead must be specified. Not specifying either is
 * an invalid configuration.
 */
class NodeAllocatableResource implements JsonSerializable
{
    /**
     * Mapping is used when the device directly models a node allocatable resource like
     * standard CPU or memory (e.g., with a CPU DRA driver). The calculated quantity is
     * accounted for exactly once per claim instance on the node. To prevent node
     * cgroup isolation friction, the scheduler explicitly blocks sharing mapped device
     * claims across multiple pods.
     */
    private NodeAllocatableMapping|null $mapping = null;

    /**
     * Overhead contains fields for modeling auxiliary overhead incurred on node
     * allocatable resources when allocating devices that are not themselves modeling a
     * node allocatable resource (e.g., host memory overhead for GPUs). Sharing
     * overhead-mapped claims across multiple pods is allowed. The node allocatable
     * overhead is accounted for individually for each pod referencing the claim.
     * Overhead is always subtracted from the node's allocatable capacity for the
     * resource, even when mapping is specified for the same resource. Eg: If a device
     * models memory capacity per socket as a consumable capacity pool via Mapping
     * (with CapacityKey), any overhead specified for the same resource will be
     * subtracted from the node's general allocatable capacity and not from the
     * per-socket capacity pool in Mapping.
     */
    private NodeAllocatableOverhead|null $overhead = null;

    public function __construct()
    {
    }

    public function getMapping(): NodeAllocatableMapping|null
    {
        return $this->mapping;
    }

    public function getOverhead(): NodeAllocatableOverhead|null
    {
        return $this->overhead;
    }

    public function mapping(): NodeAllocatableMapping
    {
        return $this->mapping ??= new NodeAllocatableMapping();
    }

    public function overhead(): NodeAllocatableOverhead
    {
        return $this->overhead ??= new NodeAllocatableOverhead();
    }

    public function setMapping(NodeAllocatableMapping $mapping): self
    {
        $this->mapping = $mapping;

        return $this;
    }

    public function setOverhead(NodeAllocatableOverhead $overhead): self
    {
        $this->overhead = $overhead;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'mapping' => $this->mapping,
            'overhead' => $this->overhead,
        ]);
    }
}
