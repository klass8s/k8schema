<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * ContainerExtendedResourceRequest has the mapping of container name, extended
 * resource name to the device request name.
 */
class ContainerExtendedResourceRequest implements JsonSerializable
{
    /**
     * The name of the container requesting resources.
     */
    private string $containerName;

    /**
     * The name of the request in the special ResourceClaim which corresponds to the
     * extended resource.
     */
    private string $requestName;

    /**
     * The name of the extended resource in that container which gets backed by DRA.
     */
    private string $resourceName;

    public function __construct(string $containerName, string $requestName, string $resourceName)
    {
        $this->containerName = $containerName;
        $this->requestName = $requestName;
        $this->resourceName = $resourceName;
    }

    public function getContainerName(): string
    {
        return $this->containerName;
    }

    public function getRequestName(): string
    {
        return $this->requestName;
    }

    public function getResourceName(): string
    {
        return $this->resourceName;
    }

    public function setContainerName(string $containerName): self
    {
        $this->containerName = $containerName;

        return $this;
    }

    public function setRequestName(string $requestName): self
    {
        $this->requestName = $requestName;

        return $this;
    }

    public function setResourceName(string $resourceName): self
    {
        $this->resourceName = $resourceName;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'containerName' => $this->containerName,
            'requestName' => $this->requestName,
            'resourceName' => $this->resourceName,
        ]);
    }
}
