<?php

declare(strict_types=1);

namespace K8Schema\Api\Networking\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ConditionList;

/**
 * ServiceCIDRStatus describes the current state of the ServiceCIDR.
 */
class ServiceCIDRStatus implements JsonSerializable
{
    /**
     * conditions holds an array of metav1.Condition that describe the state of the
     * ServiceCIDR. Current service state
     */
    private ConditionList $conditions;

    public function __construct()
    {
        $this->conditions = new ConditionList();
    }

    public function conditions(): ConditionList
    {
        return $this->conditions;
    }

    public function setConditions(ConditionList $conditions): self
    {
        $this->conditions = $conditions;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'conditions' => $this->conditions,
        ]);
    }
}
