<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1alpha3;

use ArrayObject;
use JsonSerializable;

/**
 * WorkloadPodGroupDisruptionMode defines how individual pods within a group can be
 * disrupted. Exactly one mode must be set.
 */
class WorkloadPodGroupDisruptionMode implements JsonSerializable
{
    /**
     * all specifies that all pods in the group must be disrupted together.
     */
    private WorkloadPodGroupAllDisruptionMode|null $all = null;

    /**
     * single specifies that pods can be disrupted independently from each other.
     */
    private WorkloadPodGroupSingleDisruptionMode|null $single = null;

    public function __construct()
    {
    }

    public function all(): WorkloadPodGroupAllDisruptionMode
    {
        return $this->all ??= new WorkloadPodGroupAllDisruptionMode();
    }

    public function getAll(): WorkloadPodGroupAllDisruptionMode|null
    {
        return $this->all;
    }

    public function getSingle(): WorkloadPodGroupSingleDisruptionMode|null
    {
        return $this->single;
    }

    public function setAll(WorkloadPodGroupAllDisruptionMode $all): self
    {
        $this->all = $all;

        return $this;
    }

    public function setSingle(WorkloadPodGroupSingleDisruptionMode $single): self
    {
        $this->single = $single;

        return $this;
    }

    public function single(): WorkloadPodGroupSingleDisruptionMode
    {
        return $this->single ??= new WorkloadPodGroupSingleDisruptionMode();
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'all' => $this->all,
            'single' => $this->single,
        ]);
    }
}
