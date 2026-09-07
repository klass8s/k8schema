<?php

declare(strict_types=1);

namespace K8Schema\Api\Networking\V1;

use ArrayObject;
use JsonSerializable;

/**
 * IPAddressSpec describe the attributes in an IP Address.
 */
class IPAddressSpec implements JsonSerializable
{
    /**
     * parentRef references the resource that an IPAddress is attached to. An IPAddress
     * must reference a parent object.
     */
    private ParentReference $parentRef;

    public function __construct(ParentReference $parentRef)
    {
        $this->parentRef = $parentRef;
    }

    public function getParentRef(): ParentReference
    {
        return $this->parentRef;
    }

    public function setParentRef(ParentReference $parentRef): self
    {
        $this->parentRef = $parentRef;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'parentRef' => $this->parentRef,
        ]);
    }
}
