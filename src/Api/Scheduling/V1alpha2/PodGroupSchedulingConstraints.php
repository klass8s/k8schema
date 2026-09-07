<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1alpha2;

use ArrayObject;
use JsonSerializable;

/**
 * PodGroupSchedulingConstraints defines scheduling constraints (e.g. topology) for
 * a PodGroup.
 */
class PodGroupSchedulingConstraints implements JsonSerializable
{
    /**
     * Topology defines the topology constraints for the pod group. Currently only a
     * single topology constraint can be specified. This may change in the future.
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
