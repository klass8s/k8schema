<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1alpha3;

use ArrayObject;
use JsonSerializable;

/**
 * WorkloadPodGroupSchedulingConstraints defines leaf-level scheduling constraints,
 * such as topology.
 */
class WorkloadPodGroupSchedulingConstraints implements JsonSerializable
{
    /**
     * topology specifies desired topological placements for all pods within the pod
     * group. If unset, no topology placement is requested.
     */
    private TopologyConstraintList $topology;

    public function __construct()
    {
        $this->topology = new TopologyConstraintList();
    }

    public function setTopology(TopologyConstraintList $topology): self
    {
        $this->topology = $topology;

        return $this;
    }

    public function topology(): TopologyConstraintList
    {
        return $this->topology;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'topology' => $this->topology,
        ]);
    }
}
