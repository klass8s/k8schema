<?php

declare(strict_types=1);

namespace K8Schema\Api\Flowcontrol\V1;

use ArrayObject;
use JsonSerializable;

/**
 * PriorityLevelConfigurationStatus represents the current state of a
 * "request-priority".
 */
class PriorityLevelConfigurationStatus implements JsonSerializable
{
    /**
     * `conditions` is the current state of "request-priority".
     */
    private PriorityLevelConfigurationConditionList $conditions;

    public function __construct()
    {
        $this->conditions = new PriorityLevelConfigurationConditionList();
    }

    public function conditions(): PriorityLevelConfigurationConditionList
    {
        return $this->conditions;
    }

    public function setConditions(PriorityLevelConfigurationConditionList $conditions): self
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
