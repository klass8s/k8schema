<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1alpha1;

use ArrayObject;
use JsonSerializable;

/**
 * TypedLocalObjectReference allows to reference typed object inside the same
 * namespace.
 */
class TypedLocalObjectReference implements JsonSerializable
{
    /**
     * APIGroup is the group for the resource being referenced. If APIGroup is empty,
     * the specified Kind must be in the core API group. For any other third-party
     * types, setting APIGroup is required. It must be a DNS subdomain.
     */
    private string|null $apiGroup = null;

    /**
     * Kind is the type of resource being referenced. It must be a path segment name.
     */
    private string $kind;

    /**
     * Name is the name of resource being referenced. It must be a path segment name.
     */
    private string $name;

    public function __construct(string $kind, string $name)
    {
        $this->kind = $kind;
        $this->name = $name;
    }

    public function getApiGroup(): string|null
    {
        return $this->apiGroup;
    }

    public function getKind(): string
    {
        return $this->kind;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setApiGroup(string $apiGroup): self
    {
        $this->apiGroup = $apiGroup;

        return $this;
    }

    public function setKind(string $kind): self
    {
        $this->kind = $kind;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'apiGroup' => $this->apiGroup,
            'kind' => $this->kind,
            'name' => $this->name,
        ]);
    }
}
