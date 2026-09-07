<?php

declare(strict_types=1);

namespace K8Schema\Api\Networking\V1;

use ArrayObject;
use JsonSerializable;

/**
 * IngressLoadBalancerStatus represents the status of a load-balancer.
 */
class IngressLoadBalancerStatus implements JsonSerializable
{
    /**
     * ingress is a list containing ingress points for the load-balancer.
     */
    private IngressLoadBalancerIngressList $ingress;

    public function __construct()
    {
        $this->ingress = new IngressLoadBalancerIngressList();
    }

    public function ingress(): IngressLoadBalancerIngressList
    {
        return $this->ingress;
    }

    public function setIngress(IngressLoadBalancerIngressList $ingress): self
    {
        $this->ingress = $ingress;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'ingress' => $this->ingress,
        ]);
    }
}
