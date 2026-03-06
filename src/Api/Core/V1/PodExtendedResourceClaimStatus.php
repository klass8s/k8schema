<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * PodExtendedResourceClaimStatus is stored in the PodStatus for the extended
 * resource requests backed by DRA. It stores the generated name for the
 * corresponding special ResourceClaim created by the scheduler.
 */
class PodExtendedResourceClaimStatus implements JsonSerializable
{
    /**
     * RequestMappings identifies the mapping of <container, extended resource backed
     * by DRA> to  device request in the generated ResourceClaim.
     */
    private ContainerExtendedResourceRequestList $requestMappings;

    /**
     * ResourceClaimName is the name of the ResourceClaim that was generated for the
     * Pod in the namespace of the Pod.
     */
    private string $resourceClaimName;

    public function __construct(string $resourceClaimName)
    {
        $this->requestMappings = new ContainerExtendedResourceRequestList();
        $this->resourceClaimName = $resourceClaimName;
    }

    public function getResourceClaimName(): string
    {
        return $this->resourceClaimName;
    }

    public function requestMappings(): ContainerExtendedResourceRequestList
    {
        return $this->requestMappings;
    }

    public function setRequestMappings(ContainerExtendedResourceRequestList $requestMappings): self
    {
        $this->requestMappings = $requestMappings;

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
            'requestMappings' => $this->requestMappings,
            'resourceClaimName' => $this->resourceClaimName,
        ]);
    }
}
