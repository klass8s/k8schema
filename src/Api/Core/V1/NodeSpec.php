<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringList;

/**
 * NodeSpec describes the attributes that a node is created with.
 */
class NodeSpec implements JsonSerializable
{
    /**
     * Deprecated: Previously used to specify the source of the node's configuration
     * for the DynamicKubeletConfig feature. This feature is removed.
     */
    private NodeConfigSource|null $configSource = null;

    /**
     * Deprecated. Not all kubelets will set this field. Remove field after 1.13. see:
     * https://issues.k8s.io/61966
     */
    private string|null $externalID = null;

    /**
     * PodCIDR represents the pod IP range assigned to the node.
     */
    private string|null $podCIDR = null;

    /**
     * podCIDRs represents the IP ranges assigned to the node for usage by Pods on that
     * node. If this field is specified, the 0th entry must match the podCIDR field. It
     * may contain at most 1 value for each of IPv4 and IPv6.
     */
    private StringList $podCIDRs;

    /**
     * ID of the node assigned by the cloud provider in the format:
     * <ProviderName>://<ProviderSpecificNodeID>
     */
    private string|null $providerID = null;

    /**
     * If specified, the node's taints.
     */
    private TaintList $taints;

    /**
     * Unschedulable controls node schedulability of new pods. By default, node is
     * schedulable. More info:
     * https://kubernetes.io/docs/concepts/nodes/node/#manual-node-administration
     */
    private bool|null $unschedulable = null;

    public function __construct()
    {
        $this->podCIDRs = new StringList();
        $this->taints = new TaintList();
    }

    public function configSource(): NodeConfigSource
    {
        return $this->configSource ??= new NodeConfigSource();
    }

    public function getConfigSource(): NodeConfigSource|null
    {
        return $this->configSource;
    }

    public function getExternalID(): string|null
    {
        return $this->externalID;
    }

    public function getPodCIDR(): string|null
    {
        return $this->podCIDR;
    }

    public function getProviderID(): string|null
    {
        return $this->providerID;
    }

    public function getUnschedulable(): bool|null
    {
        return $this->unschedulable;
    }

    public function podCIDRs(): StringList
    {
        return $this->podCIDRs;
    }

    public function setConfigSource(NodeConfigSource $configSource): self
    {
        $this->configSource = $configSource;

        return $this;
    }

    public function setExternalID(string $externalID): self
    {
        $this->externalID = $externalID;

        return $this;
    }

    public function setPodCIDR(string $podCIDR): self
    {
        $this->podCIDR = $podCIDR;

        return $this;
    }

    public function setPodCIDRs(StringList $podCIDRs): self
    {
        $this->podCIDRs = $podCIDRs;

        return $this;
    }

    public function setProviderID(string $providerID): self
    {
        $this->providerID = $providerID;

        return $this;
    }

    public function setTaints(TaintList $taints): self
    {
        $this->taints = $taints;

        return $this;
    }

    public function setUnschedulable(bool $unschedulable): self
    {
        $this->unschedulable = $unschedulable;

        return $this;
    }

    public function taints(): TaintList
    {
        return $this->taints;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'configSource' => $this->configSource,
            'externalID' => $this->externalID,
            'podCIDR' => $this->podCIDR,
            'podCIDRs' => $this->podCIDRs,
            'providerID' => $this->providerID,
            'taints' => $this->taints,
            'unschedulable' => $this->unschedulable,
        ]);
    }
}
