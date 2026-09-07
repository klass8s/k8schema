<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * ResourceClaimTemplate is used to produce ResourceClaim objects.
 */
class ResourceClaimTemplate implements APIResourceInterface
{
    public const string API_VERSION = 'resource.k8s.io/v1';
    public const string KIND = 'ResourceClaimTemplate';

    /**
     * Standard object metadata
     */
    private ObjectMeta $metadata;

    /**
     * Describes the ResourceClaim that is to be generated.
     *
     * This field is immutable. A ResourceClaim will get created by the control plane
     * for a Pod when needed and then not get updated anymore.
     */
    private ResourceClaimTemplateSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new ResourceClaimTemplateSpec();
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

    public function setSpec(ResourceClaimTemplateSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function spec(): ResourceClaimTemplateSpec
    {
        return $this->spec;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'metadata' => $this->metadata,
            'spec' => $this->spec,
        ]);
    }
}
