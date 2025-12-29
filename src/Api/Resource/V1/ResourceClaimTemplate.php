<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1;

use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * ResourceClaimTemplate is used to produce ResourceClaim objects.
 *
 * This is an alpha type and requires enabling the DynamicResourceAllocation
 * feature gate.
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

    public function spec(): ResourceClaimTemplateSpec
    {
        return $this->spec;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'metadata' => $this->metadata,
            'spec' => $this->spec,
        ];
    }
}
