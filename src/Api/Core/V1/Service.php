<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * Service is a named abstraction of software service (for example, mysql)
 * consisting of local port (for example 3306) that the proxy listens on, and the
 * selector that determines which pods will answer requests sent through the proxy.
 */
class Service implements APIResourceInterface
{
    public const string API_VERSION = 'v1';
    public const string KIND = 'Service';

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * Spec defines the behavior of a service.
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status
     */
    private ServiceSpec $spec;

    /**
     * Most recently observed status of the service. Populated by the system.
     * Read-only. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status
     */
    private ServiceStatus|null $status = null;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new ServiceSpec();
    }

    public function getStatus(): ServiceStatus|null
    {
        return $this->status;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function setMetadata(ObjectMeta $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    public function setSpec(ServiceSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function setStatus(ServiceStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function spec(): ServiceSpec
    {
        return $this->spec;
    }

    public function status(): ServiceStatus
    {
        return $this->status ??= new ServiceStatus();
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'metadata' => $this->metadata,
            'spec' => $this->spec,
            'status' => $this->status,
        ]);
    }
}
