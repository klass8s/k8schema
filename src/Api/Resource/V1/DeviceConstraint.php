<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringList;

/**
 * DeviceConstraint must have exactly one field set besides Requests.
 */
class DeviceConstraint implements JsonSerializable
{
    /**
     * DistinctAttribute requires that all devices in question have this attribute and
     * that its type and value are unique across those devices.
     *
     * This acts as the inverse of MatchAttribute.
     *
     * This constraint is used to avoid allocating multiple requests to the same device
     * by ensuring attribute-level differentiation.
     *
     * This is useful for scenarios where resource requests must be fulfilled by
     * separate physical devices. For example, a container requests two network
     * interfaces that must be allocated from two different physical NICs.
     */
    private string|null $distinctAttribute = null;

    /**
     * MatchAttribute requires that all devices in question have this attribute and
     * that its type and value are the same across those devices.
     *
     * For example, if you specified "dra.example.com/numa" (a hypothetical example!),
     * then only devices in the same NUMA node will be chosen. A device which does not
     * have that attribute will not be chosen. All devices should use a value of the
     * same type for this attribute because that is part of its specification, but if
     * one device doesn't, then it also will not be chosen.
     *
     * Must include the domain qualifier.
     */
    private string|null $matchAttribute = null;

    /**
     * Requests is a list of the one or more requests in this claim which must
     * co-satisfy this constraint. If a request is fulfilled by multiple devices, then
     * all of the devices must satisfy the constraint. If this is not specified, this
     * constraint applies to all requests in this claim.
     *
     * References to subrequests must include the name of the main request and may
     * include the subrequest using the format <main request>[/<subrequest>]. If just
     * the main request is given, the constraint applies to all subrequests.
     */
    private StringList $requests;

    public function __construct()
    {
        $this->requests = new StringList();
    }

    public function getDistinctAttribute(): string|null
    {
        return $this->distinctAttribute;
    }

    public function getMatchAttribute(): string|null
    {
        return $this->matchAttribute;
    }

    public function requests(): StringList
    {
        return $this->requests;
    }

    public function setDistinctAttribute(string $distinctAttribute): self
    {
        $this->distinctAttribute = $distinctAttribute;

        return $this;
    }

    public function setMatchAttribute(string $matchAttribute): self
    {
        $this->matchAttribute = $matchAttribute;

        return $this;
    }

    public function setRequests(StringList $requests): self
    {
        $this->requests = $requests;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'distinctAttribute' => $this->distinctAttribute,
            'matchAttribute' => $this->matchAttribute,
            'requests' => $this->requests,
        ]);
    }
}
