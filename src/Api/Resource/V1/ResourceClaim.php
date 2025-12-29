<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1;

use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * ResourceClaim describes a request for access to resources in the cluster, for
 * use by workloads. For example, if a workload needs an accelerator device with
 * specific properties, this is how that request is expressed. The status stanza
 * tracks whether this claim has been satisfied and what specific resources have
 * been allocated.
 *
 * This is an alpha type and requires enabling the DynamicResourceAllocation
 * feature gate.
 */
class ResourceClaim implements APIResourceInterface
{
    public const string API_VERSION = 'resource.k8s.io/v1';
    public const string KIND = 'ResourceClaim';

    /**
     * Standard object metadata
     */
    private ObjectMeta $metadata;

    /**
     * Spec describes what is being requested and how to configure it. The spec is
     * immutable.
     */
    private ResourceClaimSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new ResourceClaimSpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function spec(): ResourceClaimSpec
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
