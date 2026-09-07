<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * LoadBalancerStatus represents the status of a load-balancer.
 */
class LoadBalancerStatus implements JsonSerializable
{
    /**
     * Ingress is a list containing ingress points for the load-balancer. Traffic
     * intended for the service should be sent to these ingress points.
     */
    private LoadBalancerIngressList $ingress;

    public function __construct()
    {
        $this->ingress = new LoadBalancerIngressList();
    }

    public function ingress(): LoadBalancerIngressList
    {
        return $this->ingress;
    }

    public function setIngress(LoadBalancerIngressList $ingress): self
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
