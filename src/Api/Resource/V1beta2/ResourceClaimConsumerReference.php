<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1beta2;

use ArrayObject;
use JsonSerializable;

/**
 * ResourceClaimConsumerReference contains enough information to let you locate the
 * consumer of a ResourceClaim. The user must be a resource in the same namespace
 * as the ResourceClaim.
 */
class ResourceClaimConsumerReference implements JsonSerializable
{
    /**
     * APIGroup is the group for the resource being referenced. It is empty for the
     * core API. This matches the group in the APIVersion that is used when creating
     * the resources.
     */
    private string|null $apiGroup = null;

    /**
     * Name is the name of resource being referenced.
     */
    private string $name;

    /**
     * Resource is the type of resource being referenced, for example "pods".
     */
    private string $resource;

    /**
     * UID identifies exactly one incarnation of the resource.
     */
    private string $uid;

    public function __construct(string $name, string $resource, string $uid)
    {
        $this->name = $name;
        $this->resource = $resource;
        $this->uid = $uid;
    }

    public function getApiGroup(): string|null
    {
        return $this->apiGroup;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getResource(): string
    {
        return $this->resource;
    }

    public function getUid(): string
    {
        return $this->uid;
    }

    public function setApiGroup(string $apiGroup): self
    {
        $this->apiGroup = $apiGroup;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setResource(string $resource): self
    {
        $this->resource = $resource;

        return $this;
    }

    public function setUid(string $uid): self
    {
        $this->uid = $uid;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'apiGroup' => $this->apiGroup,
            'name' => $this->name,
            'resource' => $this->resource,
            'uid' => $this->uid,
        ]);
    }
}
