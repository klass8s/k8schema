<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Api\Core\V1\NodeSelector;

/**
 * ResourceSliceSpec contains the information published by the driver in one
 * ResourceSlice.
 */
class ResourceSliceSpec implements JsonSerializable
{
    /**
     * AllNodes indicates that all nodes have access to the resources in the pool.
     *
     * Exactly one of NodeName, NodeSelector, AllNodes, and PerDeviceNodeSelection must
     * be set.
     */
    private bool|null $allNodes = null;

    /**
     * Devices lists some or all of the devices in this pool.
     *
     * Must not have more than 128 entries.
     */
    private DeviceList $devices;

    /**
     * Driver identifies the DRA driver providing the capacity information. A field
     * selector can be used to list only ResourceSlice objects with a certain driver
     * name.
     *
     * Must be a DNS subdomain and should end with a DNS domain owned by the vendor of
     * the driver. This field is immutable.
     */
    private string $driver;

    /**
     * NodeName identifies the node which provides the resources in this pool. A field
     * selector can be used to list only ResourceSlice objects belonging to a certain
     * node.
     *
     * This field can be used to limit access from nodes to ResourceSlices with the
     * same node name. It also indicates to autoscalers that adding new nodes of the
     * same type as some old node might also make new resources available.
     *
     * Exactly one of NodeName, NodeSelector, AllNodes, and PerDeviceNodeSelection must
     * be set. This field is immutable.
     */
    private string|null $nodeName = null;

    /**
     * NodeSelector defines which nodes have access to the resources in the pool, when
     * that pool is not limited to a single node.
     *
     * Must use exactly one term.
     *
     * Exactly one of NodeName, NodeSelector, AllNodes, and PerDeviceNodeSelection must
     * be set.
     */
    private NodeSelector|null $nodeSelector = null;

    /**
     * PerDeviceNodeSelection defines whether the access from nodes to resources in the
     * pool is set on the ResourceSlice level or on each device. If it is set to true,
     * every device defined the ResourceSlice must specify this individually.
     *
     * Exactly one of NodeName, NodeSelector, AllNodes, and PerDeviceNodeSelection must
     * be set.
     */
    private bool|null $perDeviceNodeSelection = null;

    /**
     * Pool describes the pool that this ResourceSlice belongs to.
     */
    private ResourcePool $pool;

    /**
     * SharedCounters defines a list of counter sets, each of which has a name and a
     * list of counters available.
     *
     * The names of the SharedCounters must be unique in the ResourceSlice.
     *
     * The maximum number of counters in all sets is 32.
     */
    private CounterSetList $sharedCounters;

    public function __construct(string $driver, ResourcePool $pool)
    {
        $this->devices = new DeviceList();
        $this->driver = $driver;
        $this->pool = $pool;
        $this->sharedCounters = new CounterSetList();
    }

    public function devices(): DeviceList
    {
        return $this->devices;
    }

    public function getAllNodes(): bool|null
    {
        return $this->allNodes;
    }

    public function getDriver(): string
    {
        return $this->driver;
    }

    public function getNodeName(): string|null
    {
        return $this->nodeName;
    }

    public function getPerDeviceNodeSelection(): bool|null
    {
        return $this->perDeviceNodeSelection;
    }

    public function getPool(): ResourcePool
    {
        return $this->pool;
    }

    public function nodeSelector(): NodeSelector
    {
        return $this->nodeSelector ??= new NodeSelector();
    }

    public function setAllNodes(bool $allNodes): self
    {
        $this->allNodes = $allNodes;

        return $this;
    }

    public function setDriver(string $driver): self
    {
        $this->driver = $driver;

        return $this;
    }

    public function setNodeName(string $nodeName): self
    {
        $this->nodeName = $nodeName;

        return $this;
    }

    public function setPerDeviceNodeSelection(bool $perDeviceNodeSelection): self
    {
        $this->perDeviceNodeSelection = $perDeviceNodeSelection;

        return $this;
    }

    public function setPool(ResourcePool $pool): self
    {
        $this->pool = $pool;

        return $this;
    }

    public function sharedCounters(): CounterSetList
    {
        return $this->sharedCounters;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'allNodes' => $this->allNodes,
            'devices' => $this->devices,
            'driver' => $this->driver,
            'nodeName' => $this->nodeName,
            'nodeSelector' => $this->nodeSelector,
            'perDeviceNodeSelection' => $this->perDeviceNodeSelection,
            'pool' => $this->pool,
            'sharedCounters' => $this->sharedCounters,
        ]);
    }
}
