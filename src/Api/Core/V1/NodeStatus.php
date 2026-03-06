<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringList;
use K8Schema\Collection\StringOrFloatMap;

/**
 * NodeStatus is information about the current status of a node.
 */
class NodeStatus implements JsonSerializable
{
    /**
     * List of addresses reachable to the node. Queried from cloud provider, if
     * available. More info:
     * https://kubernetes.io/docs/reference/node/node-status/#addresses Note: This
     * field is declared as mergeable, but the merge key is not sufficiently unique,
     * which can cause data corruption when it is merged. Callers should instead use a
     * full-replacement patch. See https://pr.k8s.io/79391 for an example. Consumers
     * should assume that addresses can change during the lifetime of a Node. However,
     * there are some exceptions where this may not be possible, such as Pods that
     * inherit a Node's address in its own status or consumers of the downward API
     * (status.hostIP).
     */
    private NodeAddressList $addresses;

    /**
     * Allocatable represents the resources of a node that are available for
     * scheduling. Defaults to Capacity.
     */
    private StringOrFloatMap $allocatable;

    /**
     * Capacity represents the total resources of a node. More info:
     * https://kubernetes.io/docs/reference/node/node-status/#capacity
     */
    private StringOrFloatMap $capacity;

    /**
     * Conditions is an array of current observed node conditions. More info:
     * https://kubernetes.io/docs/reference/node/node-status/#condition
     */
    private NodeConditionList $conditions;

    /**
     * Status of the config assigned to the node via the dynamic Kubelet config
     * feature.
     */
    private NodeConfigStatus|null $config = null;

    /**
     * Endpoints of daemons running on the Node.
     */
    private NodeDaemonEndpoints|null $daemonEndpoints = null;

    /**
     * Features describes the set of features implemented by the CRI implementation.
     */
    private NodeFeatures|null $features = null;

    /**
     * List of container images on this node
     */
    private ContainerImageList $images;

    /**
     * Set of ids/uuids to uniquely identify the node. More info:
     * https://kubernetes.io/docs/reference/node/node-status/#info
     */
    private NodeSystemInfo|null $nodeInfo = null;

    /**
     * NodePhase is the recently observed lifecycle phase of the node. More info:
     * https://kubernetes.io/docs/concepts/nodes/node/#phase The field is never
     * populated, and now is deprecated.
     */
    private string|null $phase = null;

    /**
     * The available runtime handlers.
     */
    private NodeRuntimeHandlerList $runtimeHandlers;

    /**
     * List of volumes that are attached to the node.
     */
    private AttachedVolumeList $volumesAttached;

    /**
     * List of attachable volumes in use (mounted) by the node.
     */
    private StringList $volumesInUse;

    public function __construct()
    {
        $this->addresses = new NodeAddressList();
        $this->allocatable = new StringOrFloatMap();
        $this->capacity = new StringOrFloatMap();
        $this->conditions = new NodeConditionList();
        $this->images = new ContainerImageList();
        $this->runtimeHandlers = new NodeRuntimeHandlerList();
        $this->volumesAttached = new AttachedVolumeList();
        $this->volumesInUse = new StringList();
    }

    public function addresses(): NodeAddressList
    {
        return $this->addresses;
    }

    public function allocatable(): StringOrFloatMap
    {
        return $this->allocatable;
    }

    public function capacity(): StringOrFloatMap
    {
        return $this->capacity;
    }

    public function conditions(): NodeConditionList
    {
        return $this->conditions;
    }

    public function config(): NodeConfigStatus
    {
        return $this->config ??= new NodeConfigStatus();
    }

    public function daemonEndpoints(): NodeDaemonEndpoints
    {
        return $this->daemonEndpoints ??= new NodeDaemonEndpoints();
    }

    public function features(): NodeFeatures
    {
        return $this->features ??= new NodeFeatures();
    }

    public function getConfig(): NodeConfigStatus|null
    {
        return $this->config;
    }

    public function getDaemonEndpoints(): NodeDaemonEndpoints|null
    {
        return $this->daemonEndpoints;
    }

    public function getFeatures(): NodeFeatures|null
    {
        return $this->features;
    }

    public function getNodeInfo(): NodeSystemInfo|null
    {
        return $this->nodeInfo;
    }

    public function getPhase(): string|null
    {
        return $this->phase;
    }

    public function images(): ContainerImageList
    {
        return $this->images;
    }

    public function runtimeHandlers(): NodeRuntimeHandlerList
    {
        return $this->runtimeHandlers;
    }

    public function setAddresses(NodeAddressList $addresses): self
    {
        $this->addresses = $addresses;

        return $this;
    }

    public function setAllocatable(StringOrFloatMap $allocatable): self
    {
        $this->allocatable = $allocatable;

        return $this;
    }

    public function setCapacity(StringOrFloatMap $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function setConditions(NodeConditionList $conditions): self
    {
        $this->conditions = $conditions;

        return $this;
    }

    public function setConfig(NodeConfigStatus $config): self
    {
        $this->config = $config;

        return $this;
    }

    public function setDaemonEndpoints(NodeDaemonEndpoints $daemonEndpoints): self
    {
        $this->daemonEndpoints = $daemonEndpoints;

        return $this;
    }

    public function setFeatures(NodeFeatures $features): self
    {
        $this->features = $features;

        return $this;
    }

    public function setImages(ContainerImageList $images): self
    {
        $this->images = $images;

        return $this;
    }

    public function setNodeInfo(NodeSystemInfo $nodeInfo): self
    {
        $this->nodeInfo = $nodeInfo;

        return $this;
    }

    public function setPhase(string $phase): self
    {
        $this->phase = $phase;

        return $this;
    }

    public function setRuntimeHandlers(NodeRuntimeHandlerList $runtimeHandlers): self
    {
        $this->runtimeHandlers = $runtimeHandlers;

        return $this;
    }

    public function setVolumesAttached(AttachedVolumeList $volumesAttached): self
    {
        $this->volumesAttached = $volumesAttached;

        return $this;
    }

    public function setVolumesInUse(StringList $volumesInUse): self
    {
        $this->volumesInUse = $volumesInUse;

        return $this;
    }

    public function volumesAttached(): AttachedVolumeList
    {
        return $this->volumesAttached;
    }

    public function volumesInUse(): StringList
    {
        return $this->volumesInUse;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'addresses' => $this->addresses,
            'allocatable' => $this->allocatable,
            'capacity' => $this->capacity,
            'conditions' => $this->conditions,
            'config' => $this->config,
            'daemonEndpoints' => $this->daemonEndpoints,
            'features' => $this->features,
            'images' => $this->images,
            'nodeInfo' => $this->nodeInfo,
            'phase' => $this->phase,
            'runtimeHandlers' => $this->runtimeHandlers,
            'volumesAttached' => $this->volumesAttached,
            'volumesInUse' => $this->volumesInUse,
        ]);
    }
}
