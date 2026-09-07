<?php

declare(strict_types=1);

namespace K8Schema\Api\Policy\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ConditionList;
use K8Schema\K8Schema\DateTimeInterfaceMap;

/**
 * PodDisruptionBudgetStatus represents information about the status of a
 * PodDisruptionBudget. Status may trail the actual state of a system.
 */
class PodDisruptionBudgetStatus implements JsonSerializable
{
    /**
     * Conditions contain conditions for PDB. The disruption controller sets the
     * DisruptionAllowed condition. The following are known values for the reason field
     * (additional reasons could be added in the future): - SyncFailed: The controller
     * encountered an error and wasn't able to compute
     *               the number of allowed disruptions. Therefore no disruptions are
     *               allowed and the status of the condition will be False.
     * - InsufficientPods: The number of pods are either at or below the number
     *                     required by the PodDisruptionBudget. No disruptions are
     *                     allowed and the status of the condition will be False.
     * - SufficientPods: There are more pods than required by the PodDisruptionBudget.
     *                   The condition will be True, and the number of allowed
     *                   disruptions are provided by the disruptionsAllowed property.
     */
    private ConditionList $conditions;

    /**
     * current number of healthy pods
     */
    private int|null $currentHealthy = null;

    /**
     * minimum desired number of healthy pods
     */
    private int|null $desiredHealthy = null;

    /**
     * DisruptedPods contains information about pods whose eviction was processed by
     * the API server eviction subresource handler but has not yet been observed by the
     * PodDisruptionBudget controller. A pod will be in this map from the time when the
     * API server processed the eviction request to the time when the pod is seen by
     * PDB controller as having been marked for deletion (or after a timeout). The key
     * in the map is the name of the pod and the value is the time when the API server
     * processed the eviction request. If the deletion didn't occur and a pod is still
     * there it will be removed from the list automatically by PodDisruptionBudget
     * controller after some time. If everything goes smooth this map should be empty
     * for the most of the time. Large number of entries in the map may indicate
     * problems with pod deletions.
     */
    private DateTimeInterfaceMap $disruptedPods;

    /**
     * Number of pod disruptions that are currently allowed.
     */
    private int|null $disruptionsAllowed = null;

    /**
     * total number of pods counted by this disruption budget
     */
    private int|null $expectedPods = null;

    /**
     * Most recent generation observed when updating this PDB status.
     * DisruptionsAllowed and other status information is valid only if
     * observedGeneration equals to PDB's object generation.
     */
    private int|null $observedGeneration = null;

    public function __construct()
    {
        $this->conditions = new ConditionList();
        $this->disruptedPods = new DateTimeInterfaceMap();
    }

    public function conditions(): ConditionList
    {
        return $this->conditions;
    }

    public function disruptedPods(): DateTimeInterfaceMap
    {
        return $this->disruptedPods;
    }

    public function getCurrentHealthy(): int|null
    {
        return $this->currentHealthy;
    }

    public function getDesiredHealthy(): int|null
    {
        return $this->desiredHealthy;
    }

    public function getDisruptionsAllowed(): int|null
    {
        return $this->disruptionsAllowed;
    }

    public function getExpectedPods(): int|null
    {
        return $this->expectedPods;
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

    public function setCurrentHealthy(int $currentHealthy): self
    {
        $this->currentHealthy = $currentHealthy;

        return $this;
    }

    public function setDesiredHealthy(int $desiredHealthy): self
    {
        $this->desiredHealthy = $desiredHealthy;

        return $this;
    }

    public function setDisruptedPods(DateTimeInterfaceMap $disruptedPods): self
    {
        $this->disruptedPods = $disruptedPods;

        return $this;
    }

    public function setDisruptionsAllowed(int $disruptionsAllowed): self
    {
        $this->disruptionsAllowed = $disruptionsAllowed;

        return $this;
    }

    public function setExpectedPods(int $expectedPods): self
    {
        $this->expectedPods = $expectedPods;

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
            'currentHealthy' => $this->currentHealthy,
            'desiredHealthy' => $this->desiredHealthy,
            'disruptedPods' => $this->disruptedPods,
            'disruptionsAllowed' => $this->disruptionsAllowed,
            'expectedPods' => $this->expectedPods,
            'observedGeneration' => $this->observedGeneration,
        ]);
    }
}
