<?php

declare(strict_types=1);

namespace K8Schema\Api\Apps\V1;

use ArrayObject;
use JsonSerializable;

/**
 * ReplicaSetStatus represents the current status of a ReplicaSet.
 */
class ReplicaSetStatus implements JsonSerializable
{
    /**
     * The number of available replicas (ready for at least minReadySeconds) for this
     * replica set.
     */
    private int|null $availableReplicas = null;

    /**
     * Represents the latest available observations of a replica set's current state.
     */
    private ReplicaSetConditionList $conditions;

    /**
     * The number of pods that have labels matching the labels of the pod template of
     * the replicaset.
     */
    private int|null $fullyLabeledReplicas = null;

    /**
     * ObservedGeneration reflects the generation of the most recently observed
     * ReplicaSet.
     */
    private int|null $observedGeneration = null;

    /**
     * readyReplicas is the number of pods targeted by this ReplicaSet with a Ready
     * Condition.
     */
    private int|null $readyReplicas = null;

    /**
     * Replicas is the most recently observed number of replicas. More info:
     * https://kubernetes.io/docs/concepts/workloads/controllers/replicationcontroller/#what-is-a-replicationcontroller
     */
    private int $replicas;

    public function __construct(int $replicas)
    {
        $this->conditions = new ReplicaSetConditionList();
        $this->replicas = $replicas;
    }

    public function conditions(): ReplicaSetConditionList
    {
        return $this->conditions;
    }

    public function getAvailableReplicas(): int|null
    {
        return $this->availableReplicas;
    }

    public function getFullyLabeledReplicas(): int|null
    {
        return $this->fullyLabeledReplicas;
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

    public function setAvailableReplicas(int $availableReplicas): self
    {
        $this->availableReplicas = $availableReplicas;

        return $this;
    }

    public function setConditions(ReplicaSetConditionList $conditions): self
    {
        $this->conditions = $conditions;

        return $this;
    }

    public function setFullyLabeledReplicas(int $fullyLabeledReplicas): self
    {
        $this->fullyLabeledReplicas = $fullyLabeledReplicas;

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

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'availableReplicas' => $this->availableReplicas,
            'conditions' => $this->conditions,
            'fullyLabeledReplicas' => $this->fullyLabeledReplicas,
            'observedGeneration' => $this->observedGeneration,
            'readyReplicas' => $this->readyReplicas,
            'replicas' => $this->replicas,
        ]);
    }
}
