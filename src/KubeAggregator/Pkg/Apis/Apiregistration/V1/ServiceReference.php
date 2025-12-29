<?php

declare(strict_types=1);

namespace K8Schema\KubeAggregator\Pkg\Apis\Apiregistration\V1;

use JsonSerializable;

/**
 * ServiceReference holds a reference to Service.legacy.k8s.io
 */
class ServiceReference implements JsonSerializable
{
    /**
     * Name is the name of the service
     */
    private string|null $name = null;

    /**
     * Namespace is the namespace of the service
     */
    private string|null $namespace = null;

    /**
     * If specified, the port on the service that hosting webhook. Default to 443 for
     * backward compatibility. `port` should be a valid port number (1-65535,
     * inclusive).
     */
    private int|null $port = null;

    public function __construct()
    {
    }

    public function getName(): string|null
    {
        return $this->name;
    }

    public function getNamespace(): string|null
    {
        return $this->namespace;
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

    public function setPort(int $port): self
    {
        $this->port = $port;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'namespace' => $this->namespace,
            'port' => $this->port,
        ];
    }
}
