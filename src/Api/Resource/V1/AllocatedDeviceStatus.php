<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ConditionList;
use K8Schema\Apimachinery\Pkg\Runtime\RawExtension;

/**
 * AllocatedDeviceStatus contains the status of an allocated device, if the driver
 * chooses to report it. This may include driver-specific information.
 *
 * The combination of Driver, Pool, Device, and ShareID must match the
 * corresponding key in Status.Allocation.Devices.
 */
class AllocatedDeviceStatus implements JsonSerializable
{
    /**
     * Conditions contains the latest observation of the device's state. If the device
     * has been configured according to the class and claim config references, the
     * `Ready` condition should be True.
     *
     * Must not contain more than 8 entries.
     */
    private ConditionList $conditions;

    /**
     * Data contains arbitrary driver-specific data.
     *
     * The length of the raw data must be smaller or equal to 10 Ki.
     */
    private RawExtension|null $data = null;

    /**
     * Device references one device instance via its name in the driver's resource
     * pool. It must be a DNS label.
     */
    private string $device;

    /**
     * Driver specifies the name of the DRA driver whose kubelet plugin should be
     * invoked to process the allocation once the claim is needed on a node.
     *
     * Must be a DNS subdomain and should end with a DNS domain owned by the vendor of
     * the driver. It should use only lower case characters.
     */
    private string $driver;

    /**
     * NetworkData contains network-related information specific to the device.
     */
    private NetworkDeviceData|null $networkData = null;

    /**
     * This name together with the driver name and the device name field identify which
     * device was allocated (`<driver name>/<pool name>/<device name>`).
     *
     * Must not be longer than 253 characters and may contain one or more DNS
     * sub-domains separated by slashes.
     */
    private string $pool;

    /**
     * ShareID uniquely identifies an individual allocation share of the device.
     */
    private string|null $shareID = null;

    public function __construct(string $device, string $driver, string $pool)
    {
        $this->conditions = new ConditionList();
        $this->device = $device;
        $this->driver = $driver;
        $this->pool = $pool;
    }

    public function conditions(): ConditionList
    {
        return $this->conditions;
    }

    public function data(): RawExtension
    {
        return $this->data ??= new RawExtension();
    }

    public function getData(): RawExtension|null
    {
        return $this->data;
    }

    public function getDevice(): string
    {
        return $this->device;
    }

    public function getDriver(): string
    {
        return $this->driver;
    }

    public function getNetworkData(): NetworkDeviceData|null
    {
        return $this->networkData;
    }

    public function getPool(): string
    {
        return $this->pool;
    }

    public function getShareID(): string|null
    {
        return $this->shareID;
    }

    public function networkData(): NetworkDeviceData
    {
        return $this->networkData ??= new NetworkDeviceData();
    }

    public function setConditions(ConditionList $conditions): self
    {
        $this->conditions = $conditions;

        return $this;
    }

    public function setData(RawExtension $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function setDevice(string $device): self
    {
        $this->device = $device;

        return $this;
    }

    public function setDriver(string $driver): self
    {
        $this->driver = $driver;

        return $this;
    }

    public function setNetworkData(NetworkDeviceData $networkData): self
    {
        $this->networkData = $networkData;

        return $this;
    }

    public function setPool(string $pool): self
    {
        $this->pool = $pool;

        return $this;
    }

    public function setShareID(string $shareID): self
    {
        $this->shareID = $shareID;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'conditions' => $this->conditions,
            'data' => $this->data,
            'device' => $this->device,
            'driver' => $this->driver,
            'networkData' => $this->networkData,
            'pool' => $this->pool,
            'shareID' => $this->shareID,
        ]);
    }
}
