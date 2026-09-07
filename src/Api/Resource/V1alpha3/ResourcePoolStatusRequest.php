<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1alpha3;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * ResourcePoolStatusRequest triggers a one-time calculation of resource pool
 * status based on the provided filters. Once status is set, the request is
 * considered complete and will not be reprocessed. Users should delete and
 * recreate requests to get updated information.
 */
class ResourcePoolStatusRequest implements APIResourceInterface
{
    public const string API_VERSION = 'resource.k8s.io/v1alpha3';
    public const string KIND = 'ResourcePoolStatusRequest';

    /**
     * Standard object metadata
     */
    private ObjectMeta $metadata;

    /**
     * Spec defines the filters for which pools to include in the status. The spec is
     * immutable once created.
     */
    private ResourcePoolStatusRequestSpec $spec;

    /**
     * Status is populated by the controller with the calculated pool status. When
     * status is non-nil, the request is considered complete and the entire object
     * becomes immutable.
     */
    private ResourcePoolStatusRequestStatus|null $status = null;

    public function __construct(ResourcePoolStatusRequestSpec $spec)
    {
        $this->metadata = new ObjectMeta();
        $this->spec = $spec;
    }

    public function getSpec(): ResourcePoolStatusRequestSpec
    {
        return $this->spec;
    }

    public function getStatus(): ResourcePoolStatusRequestStatus|null
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

    public function setSpec(ResourcePoolStatusRequestSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function setStatus(ResourcePoolStatusRequestStatus $status): self
    {
        $this->status = $status;

        return $this;
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
