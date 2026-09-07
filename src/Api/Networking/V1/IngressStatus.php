<?php

declare(strict_types=1);

namespace K8Schema\Api\Networking\V1;

use ArrayObject;
use JsonSerializable;

/**
 * IngressStatus describe the current state of the Ingress.
 */
class IngressStatus implements JsonSerializable
{
    /**
     * loadBalancer contains the current status of the load-balancer.
     */
    private IngressLoadBalancerStatus|null $loadBalancer = null;

    public function __construct()
    {
    }

    public function getLoadBalancer(): IngressLoadBalancerStatus|null
    {
        return $this->loadBalancer;
    }

    public function loadBalancer(): IngressLoadBalancerStatus
    {
        return $this->loadBalancer ??= new IngressLoadBalancerStatus();
    }

    public function setLoadBalancer(IngressLoadBalancerStatus $loadBalancer): self
    {
        $this->loadBalancer = $loadBalancer;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'loadBalancer' => $this->loadBalancer,
        ]);
    }
}
