<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1alpha3;

use JsonSerializable;

/**
 * DeviceTaintSelector defines which device(s) a DeviceTaintRule applies to. The
 * empty selector matches all devices. Without a selector, no devices are matched.
 */
class DeviceTaintSelector implements JsonSerializable
{
    /**
     * If device is set, only devices with that name are selected. This field
     * corresponds to slice.spec.devices[].name.
     *
     * Setting also driver and pool may be required to avoid ambiguity, but is not
     * required.
     */
    private string|null $device = null;

    /**
     * If driver is set, only devices from that driver are selected. This fields
     * corresponds to slice.spec.driver.
     */
    private string|null $driver = null;

    /**
     * If pool is set, only devices in that pool are selected.
     *
     * Also setting the driver name may be useful to avoid ambiguity when different
     * drivers use the same pool name, but this is not required because selecting pools
     * from different drivers may also be useful, for example when drivers with
     * node-local devices use the node name as their pool name.
     */
    private string|null $pool = null;

    public function __construct()
    {
    }

    public function getDevice(): string|null
    {
        return $this->device;
    }

    public function getDriver(): string|null
    {
        return $this->driver;
    }

    public function getPool(): string|null
    {
        return $this->pool;
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

    public function jsonSerialize(): array
    {
        return [
            'device' => $this->device,
            'driver' => $this->driver,
            'pool' => $this->pool,
        ];
    }
}
