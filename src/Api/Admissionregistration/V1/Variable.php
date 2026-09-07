<?php

declare(strict_types=1);

namespace K8Schema\Api\Admissionregistration\V1;

use ArrayObject;
use JsonSerializable;

/**
 * Variable is the definition of a variable that is used for composition. A
 * variable is defined as a named expression.
 */
class Variable implements JsonSerializable
{
    /**
     * expression is the expression that will be evaluated as the value of the
     * variable. The CEL expression has access to the same identifiers as the CEL
     * expressions in Validation.
     */
    private string $expression;

    /**
     * name is the name of the variable. The name must be a valid CEL identifier and
     * unique among all variables. The variable can be accessed in other expressions
     * through `variables` For example, if name is "foo", the variable will be
     * available as `variables.foo`
     */
    private string $name;

    public function __construct(string $expression, string $name)
    {
        $this->expression = $expression;
        $this->name = $name;
    }

    public function getExpression(): string
    {
        return $this->expression;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setExpression(string $expression): self
    {
        $this->expression = $expression;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'expression' => $this->expression,
            'name' => $this->name,
        ]);
    }
}
