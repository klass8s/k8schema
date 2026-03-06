<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1beta1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Api\Core\V1\NodeSelector;

/**
 * AllocationResult contains attributes of an allocated resource.
 */
class AllocationResult implements JsonSerializable
{
    /**
     * Devices is the result of allocating devices.
     */
    private DeviceAllocationResult|null $devices = null;

    /**
     * NodeSelector defines where the allocated resources are available. If unset, they
     * are available everywhere.
     */
    private NodeSelector|null $nodeSelector = null;

    public function __construct()
    {
    }

    public function devices(): DeviceAllocationResult
    {
        return $this->devices ??= new DeviceAllocationResult();
    }

    public function getDevices(): DeviceAllocationResult|null
    {
        return $this->devices;
    }

    public function getNodeSelector(): NodeSelector|null
    {
        return $this->nodeSelector;
    }

    public function nodeSelector(): NodeSelector
    {
        return $this->nodeSelector ??= new NodeSelector();
    }

    public function setDevices(DeviceAllocationResult $devices): self
    {
        $this->devices = $devices;

        return $this;
    }

    public function setNodeSelector(NodeSelector $nodeSelector): self
    {
        $this->nodeSelector = $nodeSelector;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'devices' => $this->devices,
            'nodeSelector' => $this->nodeSelector,
        ]);
    }
}
