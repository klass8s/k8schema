<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * Node affinity is a group of node affinity scheduling rules.
 */
class NodeAffinity implements JsonSerializable
{
    /**
     * The scheduler will prefer to schedule pods to nodes that satisfy the affinity
     * expressions specified by this field, but it may choose a node that violates one
     * or more of the expressions. The node that is most preferred is the one with the
     * greatest sum of weights, i.e. for each node that meets all of the scheduling
     * requirements (resource request, requiredDuringScheduling affinity expressions,
     * etc.), compute a sum by iterating through the elements of this field and adding
     * "weight" to the sum if the node matches the corresponding matchExpressions; the
     * node(s) with the highest sum are the most preferred.
     */
    private PreferredSchedulingTermList $preferredDuringSchedulingIgnoredDuringExecution;

    /**
     * If the affinity requirements specified by this field are not met at scheduling
     * time, the pod will not be scheduled onto the node. If the affinity requirements
     * specified by this field cease to be met at some point during pod execution (e.g.
     * due to an update), the system may or may not try to eventually evict the pod
     * from its node.
     */
    private NodeSelector|null $requiredDuringSchedulingIgnoredDuringExecution = null;

    public function __construct()
    {
        $this->preferredDuringSchedulingIgnoredDuringExecution = new PreferredSchedulingTermList();
    }

    public function getRequiredDuringSchedulingIgnoredDuringExecution(): NodeSelector|null
    {
        return $this->requiredDuringSchedulingIgnoredDuringExecution;
    }

    public function preferredDuringSchedulingIgnoredDuringExecution(): PreferredSchedulingTermList
    {
        return $this->preferredDuringSchedulingIgnoredDuringExecution;
    }

    public function requiredDuringSchedulingIgnoredDuringExecution(): NodeSelector
    {
        return $this->requiredDuringSchedulingIgnoredDuringExecution ??= new NodeSelector();
    }

    public function setPreferredDuringSchedulingIgnoredDuringExecution(
        PreferredSchedulingTermList $preferredDuringSchedulingIgnoredDuringExecution,
    ): self {
        $this->preferredDuringSchedulingIgnoredDuringExecution = $preferredDuringSchedulingIgnoredDuringExecution;

        return $this;
    }

    public function setRequiredDuringSchedulingIgnoredDuringExecution(
        NodeSelector $requiredDuringSchedulingIgnoredDuringExecution,
    ): self {
        $this->requiredDuringSchedulingIgnoredDuringExecution = $requiredDuringSchedulingIgnoredDuringExecution;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'preferredDuringSchedulingIgnoredDuringExecution' => $this->preferredDuringSchedulingIgnoredDuringExecution,
            'requiredDuringSchedulingIgnoredDuringExecution' => $this->requiredDuringSchedulingIgnoredDuringExecution,
        ]);
    }
}
