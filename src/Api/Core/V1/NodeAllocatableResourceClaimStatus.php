<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringList;
use K8Schema\Collection\StringOrFloatMap;

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
     * ResourceClaimName is the resource claim referenced by the pod that resulted in
     * this node allocatable resource allocation.
     */
    private string $resourceClaimName;

    /**
     * Resources is a map of the node-allocatable resource name to the aggregate
     * quantity allocated to the claim.
     */
    private StringOrFloatMap $resources;

    public function __construct(string $resourceClaimName)
    {
        $this->containers = new StringList();
        $this->resourceClaimName = $resourceClaimName;
        $this->resources = new StringOrFloatMap();
    }

    public function containers(): StringList
    {
        return $this->containers;
    }

    public function getResourceClaimName(): string
    {
        return $this->resourceClaimName;
    }

    public function resources(): StringOrFloatMap
    {
        return $this->resources;
    }

    public function setContainers(StringList $containers): self
    {
        $this->containers = $containers;

        return $this;
    }

    public function setResourceClaimName(string $resourceClaimName): self
    {
        $this->resourceClaimName = $resourceClaimName;

        return $this;
    }

    public function setResources(StringOrFloatMap $resources): self
    {
        $this->resources = $resources;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'containers' => $this->containers,
            'resourceClaimName' => $this->resourceClaimName,
            'resources' => $this->resources,
        ]);
    }
}
