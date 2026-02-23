<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\IntList;

/**
 * ContainerRestartRuleOnExitCodes describes the condition for handling an exited
 * container based on its exit codes.
 */
class ContainerRestartRuleOnExitCodes implements JsonSerializable
{
    /**
     * Represents the relationship between the container exit code(s) and the specified
     * values. Possible values are: - In: the requirement is satisfied if the container
     * exit code is in the
     *   set of specified values.
     * - NotIn: the requirement is satisfied if the container exit code is
     *   not in the set of specified values.
     */
    private string $operator;

    /**
     * Specifies the set of values to check for container exit codes. At most 255
     * elements are allowed.
     */
    private IntList $values;

    public function __construct(string $operator)
    {
        $this->operator = $operator;
        $this->values = new IntList();
    }

    public function getOperator(): string
    {
        return $this->operator;
    }

    public function setOperator(string $operator): self
    {
        $this->operator = $operator;

        return $this;
    }

    public function setValues(IntList $values): self
    {
        $this->values = $values;

        return $this;
    }

    public function values(): IntList
    {
        return $this->values;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'operator' => $this->operator,
            'values' => $this->values,
        ]);
    }
}
