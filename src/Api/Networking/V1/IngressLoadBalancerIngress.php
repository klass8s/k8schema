<?php

declare(strict_types=1);

namespace K8Schema\Api\Networking\V1;

use ArrayObject;
use JsonSerializable;

/**
 * IngressLoadBalancerIngress represents the status of a load-balancer ingress
 * point.
 */
class IngressLoadBalancerIngress implements JsonSerializable
{
    /**
     * hostname is set for load-balancer ingress points that are DNS based.
     */
    private string|null $hostname = null;

    /**
     * ip is set for load-balancer ingress points that are IP based.
     */
    private string|null $ip = null;

    /**
     * ports provides information about the ports exposed by this LoadBalancer.
     */
    private IngressPortStatusList $ports;

    public function __construct()
    {
        $this->ports = new IngressPortStatusList();
    }

    public function getHostname(): string|null
    {
        return $this->hostname;
    }

    public function getIp(): string|null
    {
        return $this->ip;
    }

    public function ports(): IngressPortStatusList
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

    public function setPorts(IngressPortStatusList $ports): self
    {
        $this->ports = $ports;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'hostname' => $this->hostname,
            'ip' => $this->ip,
            'ports' => $this->ports,
        ]);
    }
}
