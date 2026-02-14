<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * ResourceClaimTemplateSpec contains the metadata and fields for a ResourceClaim.
 */
class ResourceClaimTemplateSpec implements JsonSerializable
{
    /**
     * ObjectMeta may contain labels and annotations that will be copied into the
     * ResourceClaim when creating it. No other fields are allowed and will be rejected
     * during validation.
     */
    private ObjectMeta $metadata;

    /**
     * Spec for the ResourceClaim. The entire content is copied unchanged into the
     * ResourceClaim that gets created from this template. The same fields as in a
     * ResourceClaim are also valid here.
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

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'metadata' => $this->metadata,
            'spec' => $this->spec,
        ]);
    }
}
