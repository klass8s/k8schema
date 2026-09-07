<?php

declare(strict_types=1);

namespace K8Schema\Api\Apiserverinternal\V1alpha1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * Storage version of a specific resource.
 */
class StorageVersion implements APIResourceInterface
{
    public const string API_VERSION = 'internal.apiserver.k8s.io/v1alpha1';
    public const string KIND = 'StorageVersion';

    /**
     * metadata is the standard object metadata. The name is <group>.<resource>.
     */
    private ObjectMeta $metadata;

    /**
     * spec is an empty spec. It is here to comply with Kubernetes API style.
     */
    private StorageVersionSpec $spec;

    /**
     * status on the version the API server instance can decode from and encode objects
     * to when persisting objects in the backend.
     */
    private StorageVersionStatus|null $status = null;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new StorageVersionSpec();
    }

    public function getStatus(): StorageVersionStatus|null
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

    public function setSpec(StorageVersionSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function setStatus(StorageVersionStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function spec(): StorageVersionSpec
    {
        return $this->spec;
    }

    public function status(): StorageVersionStatus
    {
        return $this->status ??= new StorageVersionStatus();
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
