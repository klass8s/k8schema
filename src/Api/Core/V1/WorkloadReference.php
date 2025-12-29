<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use JsonSerializable;

/**
 * WorkloadReference identifies the Workload object and PodGroup membership that a
 * Pod belongs to. The scheduler uses this information to apply workload-aware
 * scheduling semantics.
 */
class WorkloadReference implements JsonSerializable
{
    /**
     * Name defines the name of the Workload object this Pod belongs to. Workload must
     * be in the same namespace as the Pod. If it doesn't match any existing Workload,
     * the Pod will remain unschedulable until a Workload object is created and
     * observed by the kube-scheduler. It must be a DNS subdomain.
     */
    private string $name;

    /**
     * PodGroup is the name of the PodGroup within the Workload that this Pod belongs
     * to. If it doesn't match any existing PodGroup within the Workload, the Pod will
     * remain unschedulable until the Workload object is recreated and observed by the
     * kube-scheduler. It must be a DNS label.
     */
    private string $podGroup;

    /**
     * PodGroupReplicaKey specifies the replica key of the PodGroup to which this Pod
     * belongs. It is used to distinguish pods belonging to different replicas of the
     * same pod group. The pod group policy is applied separately to each replica. When
     * set, it must be a DNS label.
     */
    private string|null $podGroupReplicaKey = null;

    public function __construct(string $name, string $podGroup)
    {
        $this->name = $name;
        $this->podGroup = $podGroup;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPodGroup(): string
    {
        return $this->podGroup;
    }

    public function getPodGroupReplicaKey(): string|null
    {
        return $this->podGroupReplicaKey;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setPodGroup(string $podGroup): self
    {
        $this->podGroup = $podGroup;

        return $this;
    }

    public function setPodGroupReplicaKey(string $podGroupReplicaKey): self
    {
        $this->podGroupReplicaKey = $podGroupReplicaKey;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'podGroup' => $this->podGroup,
            'podGroupReplicaKey' => $this->podGroupReplicaKey,
        ];
    }
}
