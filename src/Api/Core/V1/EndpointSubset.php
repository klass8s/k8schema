<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * EndpointSubset is a group of addresses with a common set of ports. The expanded
 * set of endpoints is the Cartesian product of Addresses x Ports. For example,
 * given:
 *
 * 	{
 * 	  Addresses: [{"ip": "10.10.1.1"}, {"ip": "10.10.2.2"}],
 * 	  Ports:     [{"name": "a", "port": 8675}, {"name": "b", "port": 309}]
 * 	}
 *
 * The resulting set of endpoints can be viewed as:
 *
 * 	a: [ 10.10.1.1:8675, 10.10.2.2:8675 ],
 * 	b: [ 10.10.1.1:309, 10.10.2.2:309 ]
 */
class EndpointSubset implements JsonSerializable
{
    /**
     * IP addresses which offer the related ports that are marked as ready. These
     * endpoints should be considered safe for load balancers and clients to utilize.
     */
    private EndpointAddressList $addresses;

    /**
     * IP addresses which offer the related ports but are not currently marked as ready
     * because they have not yet finished starting, have recently failed a readiness
     * check, or have recently failed a liveness check.
     */
    private EndpointAddressList $notReadyAddresses;

    /**
     * Port numbers available on the related IP addresses.
     */
    private EndpointPortList $ports;

    public function __construct()
    {
        $this->addresses = new EndpointAddressList();
        $this->notReadyAddresses = new EndpointAddressList();
        $this->ports = new EndpointPortList();
    }

    public function addresses(): EndpointAddressList
    {
        return $this->addresses;
    }

    public function notReadyAddresses(): EndpointAddressList
    {
        return $this->notReadyAddresses;
    }

    public function ports(): EndpointPortList
    {
        return $this->ports;
    }

    public function setAddresses(EndpointAddressList $addresses): self
    {
        $this->addresses = $addresses;

        return $this;
    }

    public function setNotReadyAddresses(EndpointAddressList $notReadyAddresses): self
    {
        $this->notReadyAddresses = $notReadyAddresses;

        return $this;
    }

    public function setPorts(EndpointPortList $ports): self
    {
        $this->ports = $ports;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'addresses' => $this->addresses,
            'notReadyAddresses' => $this->notReadyAddresses,
            'ports' => $this->ports,
        ]);
    }
}
