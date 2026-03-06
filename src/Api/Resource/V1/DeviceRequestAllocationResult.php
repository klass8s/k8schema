<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringList;
use K8Schema\Collection\StringOrFloatMap;

/**
 * DeviceRequestAllocationResult contains the allocation result for one request.
 */
class DeviceRequestAllocationResult implements JsonSerializable
{
    /**
     * AdminAccess indicates that this device was allocated for administrative access.
     * See the corresponding request field for a definition of mode.
     *
     * This is an alpha field and requires enabling the DRAAdminAccess feature gate.
     * Admin access is disabled if this field is unset or set to false, otherwise it is
     * enabled.
     */
    private bool|null $adminAccess = null;

    /**
     * BindingConditions contains a copy of the BindingConditions from the
     * corresponding ResourceSlice at the time of allocation.
     *
     * This is an alpha field and requires enabling the DRADeviceBindingConditions and
     * DRAResourceClaimDeviceStatus feature gates.
     */
    private StringList $bindingConditions;

    /**
     * BindingFailureConditions contains a copy of the BindingFailureConditions from
     * the corresponding ResourceSlice at the time of allocation.
     *
     * This is an alpha field and requires enabling the DRADeviceBindingConditions and
     * DRAResourceClaimDeviceStatus feature gates.
     */
    private StringList $bindingFailureConditions;

    /**
     * ConsumedCapacity tracks the amount of capacity consumed per device as part of
     * the claim request. The consumed amount may differ from the requested amount: it
     * is rounded up to the nearest valid value based on the device’s requestPolicy
     * if applicable (i.e., may not be less than the requested amount).
     *
     * The total consumed capacity for each device must not exceed the DeviceCapacity's
     * Value.
     *
     * This field is populated only for devices that allow multiple allocations. All
     * capacity entries are included, even if the consumed amount is zero.
     */
    private StringOrFloatMap $consumedCapacity;

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
     * This name together with the driver name and the device name field identify which
     * device was allocated (`<driver name>/<pool name>/<device name>`).
     *
     * Must not be longer than 253 characters and may contain one or more DNS
     * sub-domains separated by slashes.
     */
    private string $pool;

    /**
     * Request is the name of the request in the claim which caused this device to be
     * allocated. If it references a subrequest in the firstAvailable list on a
     * DeviceRequest, this field must include both the name of the main request and the
     * subrequest using the format <main request>/<subrequest>.
     *
     * Multiple devices may have been allocated per request.
     */
    private string $request;

    /**
     * ShareID uniquely identifies an individual allocation share of the device, used
     * when the device supports multiple simultaneous allocations. It serves as an
     * additional map key to differentiate concurrent shares of the same device.
     */
    private string|null $shareID = null;

    /**
     * A copy of all tolerations specified in the request at the time when the device
     * got allocated.
     *
     * The maximum number of tolerations is 16.
     *
     * This is an alpha field and requires enabling the DRADeviceTaints feature gate.
     */
    private DeviceTolerationList $tolerations;

    public function __construct(string $device, string $driver, string $pool, string $request)
    {
        $this->bindingConditions = new StringList();
        $this->bindingFailureConditions = new StringList();
        $this->consumedCapacity = new StringOrFloatMap();
        $this->device = $device;
        $this->driver = $driver;
        $this->pool = $pool;
        $this->request = $request;
        $this->tolerations = new DeviceTolerationList();
    }

    public function bindingConditions(): StringList
    {
        return $this->bindingConditions;
    }

    public function bindingFailureConditions(): StringList
    {
        return $this->bindingFailureConditions;
    }

    public function consumedCapacity(): StringOrFloatMap
    {
        return $this->consumedCapacity;
    }

    public function getAdminAccess(): bool|null
    {
        return $this->adminAccess;
    }

    public function getDevice(): string
    {
        return $this->device;
    }

    public function getDriver(): string
    {
        return $this->driver;
    }

    public function getPool(): string
    {
        return $this->pool;
    }

    public function getRequest(): string
    {
        return $this->request;
    }

    public function getShareID(): string|null
    {
        return $this->shareID;
    }

    public function setAdminAccess(bool $adminAccess): self
    {
        $this->adminAccess = $adminAccess;

        return $this;
    }

    public function setBindingConditions(StringList $bindingConditions): self
    {
        $this->bindingConditions = $bindingConditions;

        return $this;
    }

    public function setBindingFailureConditions(StringList $bindingFailureConditions): self
    {
        $this->bindingFailureConditions = $bindingFailureConditions;

        return $this;
    }

    public function setConsumedCapacity(StringOrFloatMap $consumedCapacity): self
    {
        $this->consumedCapacity = $consumedCapacity;

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

    public function setPool(string $pool): self
    {
        $this->pool = $pool;

        return $this;
    }

    public function setRequest(string $request): self
    {
        $this->request = $request;

        return $this;
    }

    public function setShareID(string $shareID): self
    {
        $this->shareID = $shareID;

        return $this;
    }

    public function setTolerations(DeviceTolerationList $tolerations): self
    {
        $this->tolerations = $tolerations;

        return $this;
    }

    public function tolerations(): DeviceTolerationList
    {
        return $this->tolerations;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'adminAccess' => $this->adminAccess,
            'bindingConditions' => $this->bindingConditions,
            'bindingFailureConditions' => $this->bindingFailureConditions,
            'consumedCapacity' => $this->consumedCapacity,
            'device' => $this->device,
            'driver' => $this->driver,
            'pool' => $this->pool,
            'request' => $this->request,
            'shareID' => $this->shareID,
            'tolerations' => $this->tolerations,
        ]);
    }
}
