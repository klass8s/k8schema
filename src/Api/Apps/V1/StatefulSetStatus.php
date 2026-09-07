<?php

declare(strict_types=1);

namespace K8Schema\Api\Apps\V1;

use ArrayObject;
use JsonSerializable;

/**
 * StatefulSetStatus represents the current state of a StatefulSet.
 */
class StatefulSetStatus implements JsonSerializable
{
    /**
     * Total number of available pods (ready for at least minReadySeconds) targeted by
     * this statefulset.
     */
    private int|null $availableReplicas = null;

    /**
     * collisionCount is the count of hash collisions for the StatefulSet. The
     * StatefulSet controller uses this field as a collision avoidance mechanism when
     * it needs to create the name for the newest ControllerRevision.
     */
    private int|null $collisionCount = null;

    /**
     * Represents the latest available observations of a statefulset's current state.
     */
    private StatefulSetConditionList $conditions;

    /**
     * currentReplicas is the number of Pods created by the StatefulSet controller from
     * the StatefulSet version indicated by currentRevision.
     */
    private int|null $currentReplicas = null;

    /**
     * currentRevision, if not empty, indicates the version of the StatefulSet used to
     * generate Pods in the sequence [0,currentReplicas).
     */
    private string|null $currentRevision = null;

    /**
     * observedGeneration is the most recent generation observed for this StatefulSet.
     * It corresponds to the StatefulSet's generation, which is updated on mutation by
     * the API Server.
     */
    private int|null $observedGeneration = null;

    /**
     * readyReplicas is the number of pods created for this StatefulSet with a Ready
     * Condition.
     */
    private int|null $readyReplicas = null;

    /**
     * replicas is the number of Pods created by the StatefulSet controller.
     */
    private int $replicas;

    /**
     * updateRevision, if not empty, indicates the version of the StatefulSet used to
     * generate Pods in the sequence [replicas-updatedReplicas,replicas)
     */
    private string|null $updateRevision = null;

    /**
     * updatedReplicas is the number of Pods created by the StatefulSet controller from
     * the StatefulSet version indicated by updateRevision.
     */
    private int|null $updatedReplicas = null;

    public function __construct(int $replicas)
    {
        $this->conditions = new StatefulSetConditionList();
        $this->replicas = $replicas;
    }

    public function conditions(): StatefulSetConditionList
    {
        return $this->conditions;
    }

    public function getAvailableReplicas(): int|null
    {
        return $this->availableReplicas;
    }

    public function getCollisionCount(): int|null
    {
        return $this->collisionCount;
    }

    public function getCurrentReplicas(): int|null
    {
        return $this->currentReplicas;
    }

    public function getCurrentRevision(): string|null
    {
        return $this->currentRevision;
    }

    public function getObservedGeneration(): int|null
    {
        return $this->observedGeneration;
    }

    public function getReadyReplicas(): int|null
    {
        return $this->readyReplicas;
    }

    public function getReplicas(): int
    {
        return $this->replicas;
    }

    public function getUpdateRevision(): string|null
    {
        return $this->updateRevision;
    }

    public function getUpdatedReplicas(): int|null
    {
        return $this->updatedReplicas;
    }

    public function setAvailableReplicas(int $availableReplicas): self
    {
        $this->availableReplicas = $availableReplicas;

        return $this;
    }

    public function setCollisionCount(int $collisionCount): self
    {
        $this->collisionCount = $collisionCount;

        return $this;
    }

    public function setConditions(StatefulSetConditionList $conditions): self
    {
        $this->conditions = $conditions;

        return $this;
    }

    public function setCurrentReplicas(int $currentReplicas): self
    {
        $this->currentReplicas = $currentReplicas;

        return $this;
    }

    public function setCurrentRevision(string $currentRevision): self
    {
        $this->currentRevision = $currentRevision;

        return $this;
    }

    public function setObservedGeneration(int $observedGeneration): self
    {
        $this->observedGeneration = $observedGeneration;

        return $this;
    }

    public function setReadyReplicas(int $readyReplicas): self
    {
        $this->readyReplicas = $readyReplicas;

        return $this;
    }

    public function setReplicas(int $replicas): self
    {
        $this->replicas = $replicas;

        return $this;
    }

    public function setUpdateRevision(string $updateRevision): self
    {
        $this->updateRevision = $updateRevision;

        return $this;
    }

    public function setUpdatedReplicas(int $updatedReplicas): self
    {
        $this->updatedReplicas = $updatedReplicas;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'availableReplicas' => $this->availableReplicas,
            'collisionCount' => $this->collisionCount,
            'conditions' => $this->conditions,
            'currentReplicas' => $this->currentReplicas,
            'currentRevision' => $this->currentRevision,
            'observedGeneration' => $this->observedGeneration,
            'readyReplicas' => $this->readyReplicas,
            'replicas' => $this->replicas,
            'updateRevision' => $this->updateRevision,
            'updatedReplicas' => $this->updatedReplicas,
        ]);
    }
}
