<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * PodReadinessGate contains the reference to a pod condition
 */
class PodReadinessGate implements JsonSerializable
{
    /**
     * ConditionType refers to a condition in the pod's condition list with matching
     * type.
     */
    private string $conditionType;

    public function __construct(string $conditionType)
    {
        $this->conditionType = $conditionType;
    }

    public function getConditionType(): string
    {
        return $this->conditionType;
    }

    public function setConditionType(string $conditionType): self
    {
        $this->conditionType = $conditionType;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'conditionType' => $this->conditionType,
        ]);
    }
}
