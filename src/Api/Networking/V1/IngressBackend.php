<?php

declare(strict_types=1);

namespace K8Schema\Api\Networking\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Api\Core\V1\TypedLocalObjectReference;

/**
 * IngressBackend describes all endpoints for a given service and port.
 */
class IngressBackend implements JsonSerializable
{
    /**
     * resource is an ObjectRef to another Kubernetes resource in the namespace of the
     * Ingress object. If resource is specified, a service.Name and service.Port must
     * not be specified. This is a mutually exclusive setting with "Service".
     */
    private TypedLocalObjectReference|null $resource = null;

    /**
     * service references a service as a backend. This is a mutually exclusive setting
     * with "Resource".
     */
    private IngressServiceBackend|null $service = null;

    public function __construct()
    {
    }

    public function getResource(): TypedLocalObjectReference|null
    {
        return $this->resource;
    }

    public function getService(): IngressServiceBackend|null
    {
        return $this->service;
    }

    public function setResource(TypedLocalObjectReference $resource): self
    {
        $this->resource = $resource;

        return $this;
    }

    public function setService(IngressServiceBackend $service): self
    {
        $this->service = $service;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'resource' => $this->resource,
            'service' => $this->service,
        ]);
    }
}
