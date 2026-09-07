<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * LoadBalancerIngress represents the status of a load-balancer ingress point:
 * traffic intended for the service should be sent to an ingress point.
 */
class LoadBalancerIngress implements JsonSerializable
{
    /**
     * Hostname is set for load-balancer ingress points that are DNS based (typically
     * AWS load-balancers)
     */
    private string|null $hostname = null;

    /**
     * IP is set for load-balancer ingress points that are IP based (typically GCE or
     * OpenStack load-balancers)
     */
    private string|null $ip = null;

    /**
     * IPMode specifies how the load-balancer IP behaves, and may only be specified
     * when the ip field is specified. Setting this to "VIP" indicates that traffic is
     * delivered to the node with the destination set to the load-balancer's IP and
     * port. Setting this to "Proxy" indicates that traffic is delivered to the node or
     * pod with the destination set to the node's IP and node port or the pod's IP and
     * port. Service implementations may use this information to adjust traffic
     * routing.
     */
    private string|null $ipMode = null;

    /**
     * Ports is a list of records of service ports If used, every port defined in the
     * service should have an entry in it
     */
    private PortStatusList $ports;

    public function __construct()
    {
        $this->ports = new PortStatusList();
    }

    public function getHostname(): string|null
    {
        return $this->hostname;
    }

    public function getIp(): string|null
    {
        return $this->ip;
    }

    public function getIpMode(): string|null
    {
        return $this->ipMode;
    }

    public function ports(): PortStatusList
    {
        return $this->ports;
    }

    public function setHostname(string $hostname): self
    {
        $this->hostname = $hostname;

        return $this;
    }

    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function setIpMode(string $ipMode): self
    {
        $this->ipMode = $ipMode;

        return $this;
    }

    public function setPorts(PortStatusList $ports): self
    {
        $this->ports = $ports;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'hostname' => $this->hostname,
            'ip' => $this->ip,
            'ipMode' => $this->ipMode,
            'ports' => $this->ports,
        ]);
    }
}
