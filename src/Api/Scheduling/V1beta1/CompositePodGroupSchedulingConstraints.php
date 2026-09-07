<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1beta1;

use ArrayObject;
use JsonSerializable;

/**
 * CompositePodGroupSchedulingConstraints defines scheduling constraints (e.g.
 * topology) for a CompositePodGroup.
 */
class CompositePodGroupSchedulingConstraints implements JsonSerializable
{
    /**
     * topology defines the topology constraints for the composite pod group. Currently
     * only a single topology constraint can be specified. This may change in the
     * future.
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
