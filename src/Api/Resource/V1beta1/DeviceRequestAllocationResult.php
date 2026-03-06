<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1beta1;

use ArrayObject;
use JsonSerializable;

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
     * Device references one device instance via its name in the driver's resource
     * pool. It must be a DNS label.
     */
    private string $device;

    /**
     * Driver specifies the name of the DRA driver whose kubelet plugin should be
     * invoked to process the allocation once the claim is needed on a node.
     *
     * Must be a DNS subdomain and should end with a DNS domain owned by the vendor of
     * the driver.
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
     * allocated. Multiple devices may have been allocated per request.
     */
    private string $request;

    public function __construct(string $device, string $driver, string $pool, string $request)
    {
        $this->device = $device;
        $this->driver = $driver;
        $this->pool = $pool;
        $this->request = $request;
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

    public function setAdminAccess(bool $adminAccess): self
    {
        $this->adminAccess = $adminAccess;

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

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'adminAccess' => $this->adminAccess,
            'device' => $this->device,
            'driver' => $this->driver,
            'pool' => $this->pool,
            'request' => $this->request,
        ]);
    }
}
