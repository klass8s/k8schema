<?php

declare(strict_types=1);

namespace K8Schema\Api\Node\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Api\Core\V1\TolerationList;
use K8Schema\Collection\StringMap;

/**
 * Scheduling specifies the scheduling constraints for nodes supporting a
 * RuntimeClass.
 */
class Scheduling implements JsonSerializable
{
    /**
     * nodeSelector lists labels that must be present on nodes that support this
     * RuntimeClass. Pods using this RuntimeClass can only be scheduled to a node
     * matched by this selector. The RuntimeClass nodeSelector is merged with a pod's
     * existing nodeSelector. Any conflicts will cause the pod to be rejected in
     * admission.
     */
    private StringMap $nodeSelector;

    /**
     * tolerations are appended (excluding duplicates) to pods running with this
     * RuntimeClass during admission, effectively unioning the set of nodes tolerated
     * by the pod and the RuntimeClass.
     */
    private TolerationList $tolerations;

    public function __construct()
    {
        $this->nodeSelector = new StringMap();
        $this->tolerations = new TolerationList();
    }

    public function nodeSelector(): StringMap
    {
        return $this->nodeSelector;
    }

    public function setNodeSelector(StringMap $nodeSelector): self
    {
        $this->nodeSelector = $nodeSelector;

        return $this;
    }

    public function setTolerations(TolerationList $tolerations): self
    {
        $this->tolerations = $tolerations;

        return $this;
    }

    public function tolerations(): TolerationList
    {
        return $this->tolerations;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'nodeSelector' => $this->nodeSelector,
            'tolerations' => $this->tolerations,
        ]);
    }
}
