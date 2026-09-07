<?php

declare(strict_types=1);

namespace K8Schema\Api\Apps\V1;

use ArrayObject;
use JsonSerializable;

/**
 * DaemonSetStatus represents the current status of a daemon set.
 */
class DaemonSetStatus implements JsonSerializable
{
    /**
     * Count of hash collisions for the DaemonSet. The DaemonSet controller uses this
     * field as a collision avoidance mechanism when it needs to create the name for
     * the newest ControllerRevision.
     */
    private int|null $collisionCount = null;

    /**
     * Represents the latest available observations of a DaemonSet's current state.
     */
    private DaemonSetConditionList $conditions;

    /**
     * The number of nodes that are running at least 1 daemon pod and are supposed to
     * run the daemon pod. More info:
     * https://kubernetes.io/docs/concepts/workloads/controllers/daemonset/
     */
    private int $currentNumberScheduled;

    /**
     * The total number of nodes that should be running the daemon pod (including nodes
     * correctly running the daemon pod). More info:
     * https://kubernetes.io/docs/concepts/workloads/controllers/daemonset/
     */
    private int $desiredNumberScheduled;

    /**
     * The number of nodes that should be running the daemon pod and have one or more
     * of the daemon pod running and available (ready for at least
     * spec.minReadySeconds)
     */
    private int|null $numberAvailable = null;

    /**
     * The number of nodes that are running the daemon pod, but are not supposed to run
     * the daemon pod. More info:
     * https://kubernetes.io/docs/concepts/workloads/controllers/daemonset/
     */
    private int $numberMisscheduled;

    /**
     * numberReady is the number of nodes that should be running the daemon pod and
     * have one or more of the daemon pod running with a Ready Condition.
     */
    private int $numberReady;

    /**
     * The number of nodes that should be running the daemon pod and have none of the
     * daemon pod running and available (ready for at least spec.minReadySeconds)
     */
    private int|null $numberUnavailable = null;

    /**
     * The most recent generation observed by the daemon set controller.
     */
    private int|null $observedGeneration = null;

    /**
     * The total number of nodes that are running updated daemon pod
     */
    private int|null $updatedNumberScheduled = null;

    public function __construct(
        int $currentNumberScheduled,
        int $desiredNumberScheduled,
        int $numberMisscheduled,
        int $numberReady,
    ) {
        $this->conditions = new DaemonSetConditionList();
        $this->currentNumberScheduled = $currentNumberScheduled;
        $this->desiredNumberScheduled = $desiredNumberScheduled;
        $this->numberMisscheduled = $numberMisscheduled;
        $this->numberReady = $numberReady;
    }

    public function conditions(): DaemonSetConditionList
    {
        return $this->conditions;
    }

    public function getCollisionCount(): int|null
    {
        return $this->collisionCount;
    }

    public function getCurrentNumberScheduled(): int
    {
        return $this->currentNumberScheduled;
    }

    public function getDesiredNumberScheduled(): int
    {
        return $this->desiredNumberScheduled;
    }

    public function getNumberAvailable(): int|null
    {
        return $this->numberAvailable;
    }

    public function getNumberMisscheduled(): int
    {
        return $this->numberMisscheduled;
    }

    public function getNumberReady(): int
    {
        return $this->numberReady;
    }

    public function getNumberUnavailable(): int|null
    {
        return $this->numberUnavailable;
    }

    public function getObservedGeneration(): int|null
    {
        return $this->observedGeneration;
    }

    public function getUpdatedNumberScheduled(): int|null
    {
        return $this->updatedNumberScheduled;
    }

    public function setCollisionCount(int $collisionCount): self
    {
        $this->collisionCount = $collisionCount;

        return $this;
    }

    public function setConditions(DaemonSetConditionList $conditions): self
    {
        $this->conditions = $conditions;

        return $this;
    }

    public function setCurrentNumberScheduled(int $currentNumberScheduled): self
    {
        $this->currentNumberScheduled = $currentNumberScheduled;

        return $this;
    }

    public function setDesiredNumberScheduled(int $desiredNumberScheduled): self
    {
        $this->desiredNumberScheduled = $desiredNumberScheduled;

        return $this;
    }

    public function setNumberAvailable(int $numberAvailable): self
    {
        $this->numberAvailable = $numberAvailable;

        return $this;
    }

    public function setNumberMisscheduled(int $numberMisscheduled): self
    {
        $this->numberMisscheduled = $numberMisscheduled;

        return $this;
    }

    public function setNumberReady(int $numberReady): self
    {
        $this->numberReady = $numberReady;

        return $this;
    }

    public function setNumberUnavailable(int $numberUnavailable): self
    {
        $this->numberUnavailable = $numberUnavailable;

        return $this;
    }

    public function setObservedGeneration(int $observedGeneration): self
    {
        $this->observedGeneration = $observedGeneration;

        return $this;
    }

    public function setUpdatedNumberScheduled(int $updatedNumberScheduled): self
    {
        $this->updatedNumberScheduled = $updatedNumberScheduled;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'collisionCount' => $this->collisionCount,
            'conditions' => $this->conditions,
            'currentNumberScheduled' => $this->currentNumberScheduled,
            'desiredNumberScheduled' => $this->desiredNumberScheduled,
            'numberAvailable' => $this->numberAvailable,
            'numberMisscheduled' => $this->numberMisscheduled,
            'numberReady' => $this->numberReady,
            'numberUnavailable' => $this->numberUnavailable,
            'observedGeneration' => $this->observedGeneration,
            'updatedNumberScheduled' => $this->updatedNumberScheduled,
        ]);
    }
}
