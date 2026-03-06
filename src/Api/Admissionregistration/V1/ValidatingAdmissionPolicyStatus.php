<?php

declare(strict_types=1);

namespace K8Schema\Api\Admissionregistration\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ConditionList;

/**
 * ValidatingAdmissionPolicyStatus represents the status of an admission validation
 * policy.
 */
class ValidatingAdmissionPolicyStatus implements JsonSerializable
{
    /**
     * The conditions represent the latest available observations of a policy's current
     * state.
     */
    private ConditionList $conditions;

    /**
     * The generation observed by the controller.
     */
    private int|null $observedGeneration = null;

    /**
     * The results of type checking for each expression. Presence of this field
     * indicates the completion of the type checking.
     */
    private TypeChecking|null $typeChecking = null;

    public function __construct()
    {
        $this->conditions = new ConditionList();
    }

    public function conditions(): ConditionList
    {
        return $this->conditions;
    }

    public function getObservedGeneration(): int|null
    {
        return $this->observedGeneration;
    }

    public function getTypeChecking(): TypeChecking|null
    {
        return $this->typeChecking;
    }

    public function setConditions(ConditionList $conditions): self
    {
        $this->conditions = $conditions;

        return $this;
    }

    public function setObservedGeneration(int $observedGeneration): self
    {
        $this->observedGeneration = $observedGeneration;

        return $this;
    }

    public function setTypeChecking(TypeChecking $typeChecking): self
    {
        $this->typeChecking = $typeChecking;

        return $this;
    }

    public function typeChecking(): TypeChecking
    {
        return $this->typeChecking ??= new TypeChecking();
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'conditions' => $this->conditions,
            'observedGeneration' => $this->observedGeneration,
            'typeChecking' => $this->typeChecking,
        ]);
    }
}
