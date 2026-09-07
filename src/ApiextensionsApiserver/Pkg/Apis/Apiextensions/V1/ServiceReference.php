<?php

declare(strict_types=1);

namespace K8Schema\ApiextensionsApiserver\Pkg\Apis\Apiextensions\V1;

use ArrayObject;
use JsonSerializable;

/**
 * ServiceReference holds a reference to Service.legacy.k8s.io
 */
class ServiceReference implements JsonSerializable
{
    /**
     * name is the name of the service. Required
     */
    private string $name;

    /**
     * namespace is the namespace of the service. Required
     */
    private string $namespace;

    /**
     * path is an optional URL path at which the webhook will be contacted.
     */
    private string|null $path = null;

    /**
     * port is an optional service port at which the webhook will be contacted. `port`
     * should be a valid port number (1-65535, inclusive). Defaults to 443 for backward
     * compatibility.
     */
    private int|null $port = null;

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

    public function getPath(): string|null
    {
        return $this->path;
    }

    public function getPort(): int|null
    {
        return $this->port;
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

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function setPort(int $port): self
    {
        $this->port = $port;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'name' => $this->name,
            'namespace' => $this->namespace,
            'path' => $this->path,
            'port' => $this->port,
        ]);
    }
}
