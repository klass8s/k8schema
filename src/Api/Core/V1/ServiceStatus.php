<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ConditionList;

/**
 * ServiceStatus represents the current status of a service.
 */
class ServiceStatus implements JsonSerializable
{
    /**
     * Current service state
     */
    private ConditionList $conditions;

    /**
     * LoadBalancer contains the current status of the load-balancer, if one is
     * present.
     */
    private LoadBalancerStatus|null $loadBalancer = null;

    public function __construct()
    {
        $this->conditions = new ConditionList();
    }

    public function conditions(): ConditionList
    {
        return $this->conditions;
    }

    public function getLoadBalancer(): LoadBalancerStatus|null
    {
        return $this->loadBalancer;
    }

    public function loadBalancer(): LoadBalancerStatus
    {
        return $this->loadBalancer ??= new LoadBalancerStatus();
    }

    public function setConditions(ConditionList $conditions): self
    {
        $this->conditions = $conditions;

        return $this;
    }

    public function setLoadBalancer(LoadBalancerStatus $loadBalancer): self
    {
        $this->loadBalancer = $loadBalancer;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'conditions' => $this->conditions,
            'loadBalancer' => $this->loadBalancer,
        ]);
    }
}
