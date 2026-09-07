<?php

declare(strict_types=1);

namespace K8Schema\Api\Admissionregistration\V1;

use ArrayObject;
use JsonSerializable;

/**
 * TypeChecking contains results of type checking the expressions in the
 * ValidatingAdmissionPolicy
 */
class TypeChecking implements JsonSerializable
{
    /**
     * expressionWarnings contains the type checking warnings for each expression.
     */
    private ExpressionWarningList $expressionWarnings;

    public function __construct()
    {
        $this->expressionWarnings = new ExpressionWarningList();
    }

    public function expressionWarnings(): ExpressionWarningList
    {
        return $this->expressionWarnings;
    }

    public function setExpressionWarnings(ExpressionWarningList $expressionWarnings): self
    {
        $this->expressionWarnings = $expressionWarnings;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'expressionWarnings' => $this->expressionWarnings,
        ]);
    }
}
