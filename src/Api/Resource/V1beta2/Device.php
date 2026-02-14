<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1beta2;

use ArrayObject;
use JsonSerializable;
use K8Schema\Api\Core\V1\NodeSelector;

/**
 * Device represents one individual hardware instance that can be selected based on
 * its attributes. Besides the name, exactly one field must be set.
 */
class Device implements JsonSerializable
{
    /**
     * AllNodes indicates that all nodes have access to the device.
     *
     * Must only be set if Spec.PerDeviceNodeSelection is set to true. At most one of
     * NodeName, NodeSelector and AllNodes can be set.
     */
    private bool|null $allNodes = null;

    /**
     * Attributes defines the set of attributes for this device. The name of each
     * attribute must be unique in that set.
     *
     * The maximum number of attributes and capacities combined is 32.
     */
    private DeviceAttributeMap $attributes;

    /**
     * Capacity defines the set of capacities for this device. The name of each
     * capacity must be unique in that set.
     *
     * The maximum number of attributes and capacities combined is 32.
     */
    private DeviceCapacityMap $capacity;

    /**
     * ConsumesCounters defines a list of references to sharedCounters and the set of
     * counters that the device will consume from those counter sets.
     *
     * There can only be a single entry per counterSet.
     *
     * The total number of device counter consumption entries must be <= 32. In
     * addition, the total number in the entire ResourceSlice must be <= 1024 (for
     * example, 64 devices with 16 counters each).
     */
    private DeviceCounterConsumptionList $consumesCounters;

    /**
     * Name is unique identifier among all devices managed by the driver in the pool.
     * It must be a DNS label.
     */
    private string $name;

    /**
     * NodeName identifies the node where the device is available.
     *
     * Must only be set if Spec.PerDeviceNodeSelection is set to true. At most one of
     * NodeName, NodeSelector and AllNodes can be set.
     */
    private string|null $nodeName = null;

    /**
     * NodeSelector defines the nodes where the device is available.
     *
     * Must use exactly one term.
     *
     * Must only be set if Spec.PerDeviceNodeSelection is set to true. At most one of
     * NodeName, NodeSelector and AllNodes can be set.
     */
    private NodeSelector|null $nodeSelector = null;

    /**
     * If specified, these are the driver-defined taints.
     *
     * The maximum number of taints is 4.
     *
     * This is an alpha field and requires enabling the DRADeviceTaints feature gate.
     */
    private DeviceTaintList $taints;

    public function __construct(string $name)
    {
        $this->attributes = new DeviceAttributeMap();
        $this->capacity = new DeviceCapacityMap();
        $this->consumesCounters = new DeviceCounterConsumptionList();
        $this->name = $name;
        $this->taints = new DeviceTaintList();
    }

    public function attributes(): DeviceAttributeMap
    {
        return $this->attributes;
    }

    public function capacity(): DeviceCapacityMap
    {
        return $this->capacity;
    }

    public function consumesCounters(): DeviceCounterConsumptionList
    {
        return $this->consumesCounters;
    }

    public function getAllNodes(): bool|null
    {
        return $this->allNodes;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNodeName(): string|null
    {
        return $this->nodeName;
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

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setNodeName(string $nodeName): self
    {
        $this->nodeName = $nodeName;

        return $this;
    }

    public function taints(): DeviceTaintList
    {
        return $this->taints;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'allNodes' => $this->allNodes,
            'attributes' => $this->attributes,
            'capacity' => $this->capacity,
            'consumesCounters' => $this->consumesCounters,
            'name' => $this->name,
            'nodeName' => $this->nodeName,
            'nodeSelector' => $this->nodeSelector,
            'taints' => $this->taints,
        ]);
    }
}
