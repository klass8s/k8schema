<?php

declare(strict_types=1);

namespace K8Schema\Api\Networking\V1;

use ArrayObject;
use JsonSerializable;

/**
 * ParentReference describes a reference to a parent object.
 */
class ParentReference implements JsonSerializable
{
    /**
     * Group is the group of the object being referenced.
     */
    private string|null $group = null;

    /**
     * Name is the name of the object being referenced.
     */
    private string $name;

    /**
     * Namespace is the namespace of the object being referenced.
     */
    private string|null $namespace = null;

    /**
     * Resource is the resource of the object being referenced.
     */
    private string $resource;

    public function __construct(string $name, string $resource)
    {
        $this->name = $name;
        $this->resource = $resource;
    }

    public function getGroup(): string|null
    {
        return $this->group;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNamespace(): string|null
    {
        return $this->namespace;
    }

    public function getResource(): string
    {
        return $this->resource;
    }

    public function setGroup(string $group): self
    {
        $this->group = $group;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setNamespace(string $namespace): self
    {
        $this->namespace = $namespace;

        return $this;
    }

    public function setResource(string $resource): self
    {
        $this->resource = $resource;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'group' => $this->group,
            'name' => $this->name,
            'namespace' => $this->namespace,
            'resource' => $this->resource,
        ]);
    }
}
