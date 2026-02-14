<?php

declare(strict_types=1);

namespace K8Schema\Api\Networking\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\LabelSelector;

/**
 * NetworkPolicyPeer describes a peer to allow traffic to/from. Only certain
 * combinations of fields are allowed
 */
class NetworkPolicyPeer implements JsonSerializable
{
    /**
     * ipBlock defines policy on a particular IPBlock. If this field is set then
     * neither of the other fields can be.
     */
    private IPBlock|null $ipBlock = null;

    /**
     * namespaceSelector selects namespaces using cluster-scoped labels. This field
     * follows standard label selector semantics; if present but empty, it selects all
     * namespaces.
     *
     * If podSelector is also set, then the NetworkPolicyPeer as a whole selects the
     * pods matching podSelector in the namespaces selected by namespaceSelector.
     * Otherwise it selects all pods in the namespaces selected by namespaceSelector.
     */
    private LabelSelector|null $namespaceSelector = null;

    /**
     * podSelector is a label selector which selects pods. This field follows standard
     * label selector semantics; if present but empty, it selects all pods.
     *
     * If namespaceSelector is also set, then the NetworkPolicyPeer as a whole selects
     * the pods matching podSelector in the Namespaces selected by NamespaceSelector.
     * Otherwise it selects the pods matching podSelector in the policy's own
     * namespace.
     */
    private LabelSelector|null $podSelector = null;

    public function __construct()
    {
    }

    public function getIpBlock(): IPBlock|null
    {
        return $this->ipBlock;
    }

    public function namespaceSelector(): LabelSelector
    {
        return $this->namespaceSelector ??= new LabelSelector();
    }

    public function podSelector(): LabelSelector
    {
        return $this->podSelector ??= new LabelSelector();
    }

    public function setIpBlock(IPBlock $ipBlock): self
    {
        $this->ipBlock = $ipBlock;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'ipBlock' => $this->ipBlock,
            'namespaceSelector' => $this->namespaceSelector,
            'podSelector' => $this->podSelector,
        ]);
    }
}
