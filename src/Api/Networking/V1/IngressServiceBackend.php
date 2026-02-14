<?php

declare(strict_types=1);

namespace K8Schema\Api\Networking\V1;

use ArrayObject;
use JsonSerializable;

/**
 * IngressServiceBackend references a Kubernetes Service as a Backend.
 */
class IngressServiceBackend implements JsonSerializable
{
    /**
     * name is the referenced service. The service must exist in the same namespace as
     * the Ingress object.
     */
    private string $name;

    /**
     * port of the referenced service. A port name or port number is required for a
     * IngressServiceBackend.
     */
    private ServiceBackendPort|null $port = null;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function port(): ServiceBackendPort
    {
        return $this->port ??= new ServiceBackendPort();
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'name' => $this->name,
            'port' => $this->port,
        ]);
    }
}
