<?php

declare(strict_types=1);

namespace K8Schema\Api\Authorization\V1;

use ArrayObject;
use JsonSerializable;

/**
 * SelfSubjectAccessReviewSpec is a description of the access request.  Exactly one
 * of ResourceAuthorizationAttributes and NonResourceAuthorizationAttributes must
 * be set
 */
class SelfSubjectAccessReviewSpec implements JsonSerializable
{
    /**
     * NonResourceAttributes describes information for a non-resource access request
     */
    private NonResourceAttributes|null $nonResourceAttributes = null;

    /**
     * ResourceAuthorizationAttributes describes information for a resource access
     * request
     */
    private ResourceAttributes|null $resourceAttributes = null;

    public function __construct()
    {
    }

    public function nonResourceAttributes(): NonResourceAttributes
    {
        return $this->nonResourceAttributes ??= new NonResourceAttributes();
    }

    public function resourceAttributes(): ResourceAttributes
    {
        return $this->resourceAttributes ??= new ResourceAttributes();
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'nonResourceAttributes' => $this->nonResourceAttributes,
            'resourceAttributes' => $this->resourceAttributes,
        ]);
    }
}
