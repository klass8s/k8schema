<?php

declare(strict_types=1);

namespace K8Schema\Api\Lifecycle\V1alpha1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ConditionList;

/**
 * EvictionRequestStatus represents the last observed status of the eviction
 * request.
 */
class EvictionRequestStatus implements JsonSerializable
{
    /**
     * conditions contain information about the eviction request.
     *
     * EvictionRequest specific conditions are: TargetEvicted or Failed (managed by
     * evictionrequest-controller). - Failed means that the eviction request is no
     * longer being processed
     *   by any eviction responder. This can happen if the request is canceled or if no
     * responder
     *   managed to evict the target (e.g. terminate or delete a pod).
     * - TargetEvicted means that the target has been evicted (e.g. a pod has been
     * terminated or deleted).
     *
     * These conditions can be reset if the eviction was unsuccessful and a new
     * Eviction intent has been submitted.
     *
     * The maximum length of the conditions list is 100.
     */
    private ConditionList $conditions;

    /**
     * observedGeneration is EvictionRequest's .metadata.generation observed by the
     * evictionrequest-controller. The observed generation value cannot be negative and
     * can only be incremented. The minimum value is 1. This field is managed by
     * evictionrequest-controller.
     */
    private int|null $observedGeneration = null;

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

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'conditions' => $this->conditions,
            'observedGeneration' => $this->observedGeneration,
        ]);
    }
}
