<?php

declare(strict_types=1);

namespace K8Schema\Api\Apps\V1;

use ArrayObject;
use JsonSerializable;

/**
 * DeploymentStatus is the most recently observed status of the Deployment.
 */
class DeploymentStatus implements JsonSerializable
{
    /**
     * Total number of available non-terminating pods (ready for at least
     * minReadySeconds) targeted by this deployment.
     */
    private int|null $availableReplicas = null;

    /**
     * Count of hash collisions for the Deployment. The Deployment controller uses this
     * field as a collision avoidance mechanism when it needs to create the name for
     * the newest ReplicaSet.
     */
    private int|null $collisionCount = null;

    /**
     * Represents the latest available observations of a deployment's current state.
     */
    private DeploymentConditionList $conditions;

    /**
     * The generation observed by the deployment controller.
     */
    private int|null $observedGeneration = null;

    /**
     * Total number of non-terminating pods targeted by this Deployment with a Ready
     * Condition.
     */
    private int|null $readyReplicas = null;

    /**
     * Total number of non-terminating pods targeted by this deployment (their labels
     * match the selector).
     */
    private int|null $replicas = null;

    /**
     * Total number of terminating pods targeted by this deployment. Terminating pods
     * have a non-null .metadata.deletionTimestamp and have not yet reached the Failed
     * or Succeeded .status.phase.
     *
     * This is an alpha field. Enable DeploymentReplicaSetTerminatingReplicas to be
     * able to use this field.
     */
    private int|null $terminatingReplicas = null;

    /**
     * Total number of unavailable pods targeted by this deployment. This is the total
     * number of pods that are still required for the deployment to have 100% available
     * capacity. They may either be pods that are running but not yet available or pods
     * that still have not been created.
     */
    private int|null $unavailableReplicas = null;

    /**
     * Total number of non-terminating pods targeted by this deployment that have the
     * desired template spec.
     */
    private int|null $updatedReplicas = null;

    public function __construct()
    {
        $this->conditions = new DeploymentConditionList();
    }

    public function conditions(): DeploymentConditionList
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

    public function getObservedGeneration(): int|null
    {
        return $this->observedGeneration;
    }

    public function getReadyReplicas(): int|null
    {
        return $this->readyReplicas;
    }

    public function getReplicas(): int|null
    {
        return $this->replicas;
    }

    public function getTerminatingReplicas(): int|null
    {
        return $this->terminatingReplicas;
    }

    public function getUnavailableReplicas(): int|null
    {
        return $this->unavailableReplicas;
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

    public function setConditions(DeploymentConditionList $conditions): self
    {
        $this->conditions = $conditions;

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

    public function setTerminatingReplicas(int $terminatingReplicas): self
    {
        $this->terminatingReplicas = $terminatingReplicas;

        return $this;
    }

    public function setUnavailableReplicas(int $unavailableReplicas): self
    {
        $this->unavailableReplicas = $unavailableReplicas;

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
            'observedGeneration' => $this->observedGeneration,
            'readyReplicas' => $this->readyReplicas,
            'replicas' => $this->replicas,
            'terminatingReplicas' => $this->terminatingReplicas,
            'unavailableReplicas' => $this->unavailableReplicas,
            'updatedReplicas' => $this->updatedReplicas,
        ]);
    }
}
