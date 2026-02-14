<?php

declare(strict_types=1);

namespace K8Schema\Api\Flowcontrol\V1;

use ArrayObject;
use JsonSerializable;

/**
 * ServiceAccountSubject holds detailed information for service-account-kind
 * subject.
 */
class ServiceAccountSubject implements JsonSerializable
{
    /**
     * `name` is the name of matching ServiceAccount objects, or "*" to match
     * regardless of name. Required.
     */
    private string $name;

    /**
     * `namespace` is the namespace of matching ServiceAccount objects. Required.
     */
    private string $namespace;

    public function __construct(string $name, string $namespace)
    {
        $this->name = $name;
        $this->namespace = $namespace;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNamespace(): string
    {
        return $this->namespace;
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

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'name' => $this->name,
            'namespace' => $this->namespace,
        ]);
    }
}
