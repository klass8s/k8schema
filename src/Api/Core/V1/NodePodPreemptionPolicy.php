<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringList;

/**
 * NodePodPreemptionPolicy defines the node-level policies governing preemption for
 * pods on this node.
 */
class NodePodPreemptionPolicy implements JsonSerializable
{
    /**
     * DisableResizePreemption lists the owners (e.g., autoscalers, operators,
     * administrators) that have requested to disable scheduler and Kubelet preemption
     * for in-place pod resize on this node. If this list is non-empty, resize-induced
     * preemption is disabled on this node. This is an alpha field and requires
     * enabling the InPlacePodVerticalScalingSchedulerPreemption feature gate.
     */
    private StringList $disableResizePreemption;

    public function __construct()
    {
        $this->disableResizePreemption = new StringList();
    }

    public function disableResizePreemption(): StringList
    {
        return $this->disableResizePreemption;
    }

    public function setDisableResizePreemption(StringList $disableResizePreemption): self
    {
        $this->disableResizePreemption = $disableResizePreemption;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'disableResizePreemption' => $this->disableResizePreemption,
        ]);
    }
}
