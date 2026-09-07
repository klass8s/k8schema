<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1alpha3;

use ArrayObject;
use JsonSerializable;

/**
 * PoolStatus contains status information for a single resource pool.
 */
class PoolStatus implements JsonSerializable
{
    /**
     * AllocatedDevices is the number of devices currently allocated to claims. A value
     * of 0 means no devices are allocated. May be unset when validationError is set.
     */
    private int|null $allocatedDevices = null;

    /**
     * AvailableDevices is the number of devices available for allocation. This equals
     * TotalDevices - AllocatedDevices - UnavailableDevices. A value of 0 means no
     * devices are currently available. May be unset when validationError is set.
     */
    private int|null $availableDevices = null;

    /**
     * Driver is the DRA driver name for this pool. Must be a DNS subdomain (e.g.,
     * "gpu.example.com").
     */
    private string $driver;

    /**
     * Generation is the pool generation observed across all ResourceSlices in this
     * pool. Only the latest generation is reported. During a generation rollout, if
     * not all slices at the latest generation have been published, the pool is
     * included with a validationError and device counts unset.
     */
    private int $generation;

    /**
     * NodeName is the node this pool is associated with. When omitted, the pool is not
     * associated with a specific node. Must be a valid DNS subdomain name (RFC1123).
     */
    private string|null $nodeName = null;

    /**
     * PoolName is the name of the pool. Must be a valid resource pool name (DNS
     * subdomains separated by "/").
     */
    private string $poolName;

    /**
     * ResourceSliceCount is the number of ResourceSlices that make up this pool. May
     * be unset when validationError is set.
     */
    private int|null $resourceSliceCount = null;

    /**
     * TotalDevices is the total number of devices in the pool across all slices. A
     * value of 0 means the pool has no devices. May be unset when validationError is
     * set.
     */
    private int|null $totalDevices = null;

    /**
     * UnavailableDevices is the number of devices that are not available due to taints
     * or other conditions, but are not allocated. A value of 0 means all unallocated
     * devices are available. May be unset when validationError is set.
     */
    private int|null $unavailableDevices = null;

    /**
     * ValidationError is set when the pool's data could not be fully validated (e.g.,
     * incomplete slice publication). When set, device count fields and
     * ResourceSliceCount may be unset.
     */
    private string|null $validationError = null;

    public function __construct(string $driver, int $generation, string $poolName)
    {
        $this->driver = $driver;
        $this->generation = $generation;
        $this->poolName = $poolName;
    }

    public function getAllocatedDevices(): int|null
    {
        return $this->allocatedDevices;
    }

    public function getAvailableDevices(): int|null
    {
        return $this->availableDevices;
    }

    public function getDriver(): string
    {
        return $this->driver;
    }

    public function getGeneration(): int
    {
        return $this->generation;
    }

    public function getNodeName(): string|null
    {
        return $this->nodeName;
    }

    public function getPoolName(): string
    {
        return $this->poolName;
    }

    public function getResourceSliceCount(): int|null
    {
        return $this->resourceSliceCount;
    }

    public function getTotalDevices(): int|null
    {
        return $this->totalDevices;
    }

    public function getUnavailableDevices(): int|null
    {
        return $this->unavailableDevices;
    }

    public function getValidationError(): string|null
    {
        return $this->validationError;
    }

    public function setAllocatedDevices(int $allocatedDevices): self
    {
        $this->allocatedDevices = $allocatedDevices;

        return $this;
    }

    public function setAvailableDevices(int $availableDevices): self
    {
        $this->availableDevices = $availableDevices;

        return $this;
    }

    public function setDriver(string $driver): self
    {
        $this->driver = $driver;

        return $this;
    }

    public function setGeneration(int $generation): self
    {
        $this->generation = $generation;

        return $this;
    }

    public function setNodeName(string $nodeName): self
    {
        $this->nodeName = $nodeName;

        return $this;
    }

    public function setPoolName(string $poolName): self
    {
        $this->poolName = $poolName;

        return $this;
    }

    public function setResourceSliceCount(int $resourceSliceCount): self
    {
        $this->resourceSliceCount = $resourceSliceCount;

        return $this;
    }

    public function setTotalDevices(int $totalDevices): self
    {
        $this->totalDevices = $totalDevices;

        return $this;
    }

    public function setUnavailableDevices(int $unavailableDevices): self
    {
        $this->unavailableDevices = $unavailableDevices;

        return $this;
    }

    public function setValidationError(string $validationError): self
    {
        $this->validationError = $validationError;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'allocatedDevices' => $this->allocatedDevices,
            'availableDevices' => $this->availableDevices,
            'driver' => $this->driver,
            'generation' => $this->generation,
            'nodeName' => $this->nodeName,
            'poolName' => $this->poolName,
            'resourceSliceCount' => $this->resourceSliceCount,
            'totalDevices' => $this->totalDevices,
            'unavailableDevices' => $this->unavailableDevices,
            'validationError' => $this->validationError,
        ]);
    }
}
