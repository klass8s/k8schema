<?php

declare(strict_types=1);

namespace K8Schema\Api\Flowcontrol\V1;

use ArrayObject;
use JsonSerializable;

/**
 * FlowSchemaStatus represents the current state of a FlowSchema.
 */
class FlowSchemaStatus implements JsonSerializable
{
    /**
     * `conditions` is a list of the current states of FlowSchema.
     */
    private FlowSchemaConditionList $conditions;

    public function __construct()
    {
        $this->conditions = new FlowSchemaConditionList();
    }

    public function conditions(): FlowSchemaConditionList
    {
        return $this->conditions;
    }

    public function setConditions(FlowSchemaConditionList $conditions): self
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
