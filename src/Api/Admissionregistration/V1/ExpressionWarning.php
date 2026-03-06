<?php

declare(strict_types=1);

namespace K8Schema\Api\Admissionregistration\V1;

use ArrayObject;
use JsonSerializable;

/**
 * ExpressionWarning is a warning information that targets a specific expression.
 */
class ExpressionWarning implements JsonSerializable
{
    /**
     * The path to the field that refers the expression. For example, the reference to
     * the expression of the first item of validations is
     * "spec.validations[0].expression"
     */
    private string $fieldRef;

    /**
     * The content of type checking information in a human-readable form. Each line of
     * the warning contains the type that the expression is checked against, followed
     * by the type check error from the compiler.
     */
    private string $warning;

    public function __construct(string $fieldRef, string $warning)
    {
        $this->fieldRef = $fieldRef;
        $this->warning = $warning;
    }

    public function getFieldRef(): string
    {
        return $this->fieldRef;
    }

    public function getWarning(): string
    {
        return $this->warning;
    }

    public function setFieldRef(string $fieldRef): self
    {
        $this->fieldRef = $fieldRef;

        return $this;
    }

    public function setWarning(string $warning): self
    {
        $this->warning = $warning;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'fieldRef' => $this->fieldRef,
            'warning' => $this->warning,
        ]);
    }
}
