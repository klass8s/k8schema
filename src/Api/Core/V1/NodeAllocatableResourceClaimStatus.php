<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringList;

/**
 * NodeAllocatableResourceClaimStatus describes the status of node allocatable
 * resources allocated via DRA.
 */
class NodeAllocatableResourceClaimStatus implements JsonSerializable
{
    /**
     * Containers lists the names of all containers in this pod that reference the
     * claim.
     */
    private StringList $containers;

    /**
     * Mapping contains allocations through devices mapped in the device spec's
     * `nodeAllocatableResources[...].mapping` field. This is used by kubelet for pod
     * level and container-level cgroup enforcement.
     */
    private NodeAllocatableMappedResourcesList $mapping;

    /**
     * Overhead contains allocations through devices mapped in the device spec's
     * `nodeAllocatableResources[...].overhead` field. This is used by kubelet for pod
     * level and container-level cgroup enforcement.
     */
    private NodeAllocatableOverheadResourcesList $overhead;

    /**
     * ResourceClaimName is the resource claim referenced by the pod that resulted in
     * this node allocatable resource allocation.
     */
    private string $resourceClaimName;

    public function __construct(string $resourceClaimName)
    {
        $this->containers = new StringList();
        $this->mapping = new NodeAllocatableMappedResourcesList();
        $this->overhead = new NodeAllocatableOverheadResourcesList();
        $this->resourceClaimName = $resourceClaimName;
    }

    public function containers(): StringList
    {
        return $this->containers;
    }

    public function getResourceClaimName(): string
    {
        return $this->resourceClaimName;
    }

    public function mapping(): NodeAllocatableMappedResourcesList
    {
        return $this->mapping;
    }

    public function overhead(): NodeAllocatableOverheadResourcesList
    {
        return $this->overhead;
    }

    public function setContainers(StringList $containers): self
    {
        $this->containers = $containers;

        return $this;
    }

    public function setMapping(NodeAllocatableMappedResourcesList $mapping): self
    {
        $this->mapping = $mapping;

        return $this;
    }

    public function setOverhead(NodeAllocatableOverheadResourcesList $overhead): self
    {
        $this->overhead = $overhead;

        return $this;
    }

    public function setResourceClaimName(string $resourceClaimName): self
    {
        $this->resourceClaimName = $resourceClaimName;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'containers' => $this->containers,
            'mapping' => $this->mapping,
            'overhead' => $this->overhead,
            'resourceClaimName' => $this->resourceClaimName,
        ]);
    }
}
