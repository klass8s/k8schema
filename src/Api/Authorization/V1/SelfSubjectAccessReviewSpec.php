<?php

declare(strict_types=1);

namespace K8Schema\Api\Authorization\V1;

use ArrayObject;
use JsonSerializable;

/**
 * SelfSubjectAccessReviewSpec is a description of the access request.  Exactly one
 * of resourceAttributes and nonResourceAttributes must be set
 */
class SelfSubjectAccessReviewSpec implements JsonSerializable
{
    /**
     * nonResourceAttributes describes information for a non-resource access request
     */
    private NonResourceAttributes|null $nonResourceAttributes = null;

    /**
     * resourceAttributes describes information for a resource access request
     */
    private ResourceAttributes|null $resourceAttributes = null;

    public function __construct()
    {
    }

    public function getNonResourceAttributes(): NonResourceAttributes|null
    {
        return $this->nonResourceAttributes;
    }

    public function getResourceAttributes(): ResourceAttributes|null
    {
        return $this->resourceAttributes;
    }

    public function nonResourceAttributes(): NonResourceAttributes
    {
        return $this->nonResourceAttributes ??= new NonResourceAttributes();
    }

    public function resourceAttributes(): ResourceAttributes
    {
        return $this->resourceAttributes ??= new ResourceAttributes();
    }

    public function setNonResourceAttributes(NonResourceAttributes $nonResourceAttributes): self
    {
        $this->nonResourceAttributes = $nonResourceAttributes;

        return $this;
    }

    public function setResourceAttributes(ResourceAttributes $resourceAttributes): self
    {
        $this->resourceAttributes = $resourceAttributes;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'nonResourceAttributes' => $this->nonResourceAttributes,
            'resourceAttributes' => $this->resourceAttributes,
        ]);
    }
}
