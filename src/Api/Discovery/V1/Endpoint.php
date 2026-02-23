<?php

declare(strict_types=1);

namespace K8Schema\Api\Discovery\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Api\Core\V1\ObjectReference;
use K8Schema\Collection\StringList;
use K8Schema\Collection\StringMap;

/**
 * Endpoint represents a single logical "backend" implementing a service.
 */
class Endpoint implements JsonSerializable
{
    /**
     * addresses of this endpoint. The contents of this field are interpreted according
     * to the corresponding EndpointSlice addressType field. Consumers must handle
     * different types of addresses in the context of their own capabilities. This must
     * contain at least one address but no more than 100. These are all assumed to be
     * fungible and clients may choose to only use the first element. Refer to:
     * https://issue.k8s.io/106267
     */
    private StringList $addresses;

    /**
     * conditions contains information about the current status of the endpoint.
     */
    private EndpointConditions|null $conditions = null;

    /**
     * deprecatedTopology contains topology information part of the v1beta1 API. This
     * field is deprecated, and will be removed when the v1beta1 API is removed (no
     * sooner than kubernetes v1.24).  While this field can hold values, it is not
     * writable through the v1 API, and any attempts to write to it will be silently
     * ignored. Topology information can be found in the zone and nodeName fields
     * instead.
     */
    private StringMap $deprecatedTopology;

    /**
     * hints contains information associated with how an endpoint should be consumed.
     */
    private EndpointHints|null $hints = null;

    /**
     * hostname of this endpoint. This field may be used by consumers of endpoints to
     * distinguish endpoints from each other (e.g. in DNS names). Multiple endpoints
     * which use the same hostname should be considered fungible (e.g. multiple A
     * values in DNS). Must be lowercase and pass DNS Label (RFC 1123) validation.
     */
    private string|null $hostname = null;

    /**
     * nodeName represents the name of the Node hosting this endpoint. This can be used
     * to determine endpoints local to a Node.
     */
    private string|null $nodeName = null;

    /**
     * targetRef is a reference to a Kubernetes object that represents this endpoint.
     */
    private ObjectReference|null $targetRef = null;

    /**
     * zone is the name of the Zone this endpoint exists in.
     */
    private string|null $zone = null;

    public function __construct()
    {
        $this->addresses = new StringList();
        $this->deprecatedTopology = new StringMap();
    }

    public function addresses(): StringList
    {
        return $this->addresses;
    }

    public function conditions(): EndpointConditions
    {
        return $this->conditions ??= new EndpointConditions();
    }

    public function deprecatedTopology(): StringMap
    {
        return $this->deprecatedTopology;
    }

    public function getConditions(): EndpointConditions|null
    {
        return $this->conditions;
    }

    public function getHints(): EndpointHints|null
    {
        return $this->hints;
    }

    public function getHostname(): string|null
    {
        return $this->hostname;
    }

    public function getNodeName(): string|null
    {
        return $this->nodeName;
    }

    public function getTargetRef(): ObjectReference|null
    {
        return $this->targetRef;
    }

    public function getZone(): string|null
    {
        return $this->zone;
    }

    public function hints(): EndpointHints
    {
        return $this->hints ??= new EndpointHints();
    }

    public function setAddresses(StringList $addresses): self
    {
        $this->addresses = $addresses;

        return $this;
    }

    public function setConditions(EndpointConditions $conditions): self
    {
        $this->conditions = $conditions;

        return $this;
    }

    public function setDeprecatedTopology(StringMap $deprecatedTopology): self
    {
        $this->deprecatedTopology = $deprecatedTopology;

        return $this;
    }

    public function setHints(EndpointHints $hints): self
    {
        $this->hints = $hints;

        return $this;
    }

    public function setHostname(string $hostname): self
    {
        $this->hostname = $hostname;

        return $this;
    }

    public function setNodeName(string $nodeName): self
    {
        $this->nodeName = $nodeName;

        return $this;
    }

    public function setTargetRef(ObjectReference $targetRef): self
    {
        $this->targetRef = $targetRef;

        return $this;
    }

    public function setZone(string $zone): self
    {
        $this->zone = $zone;

        return $this;
    }

    public function targetRef(): ObjectReference
    {
        return $this->targetRef ??= new ObjectReference();
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'addresses' => $this->addresses,
            'conditions' => $this->conditions,
            'deprecatedTopology' => $this->deprecatedTopology,
            'hints' => $this->hints,
            'hostname' => $this->hostname,
            'nodeName' => $this->nodeName,
            'targetRef' => $this->targetRef,
            'zone' => $this->zone,
        ]);
    }
}
