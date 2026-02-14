<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Apimachinery\Pkg\Runtime\RawExtension;

/**
 * OpaqueDeviceConfiguration contains configuration parameters for a driver in a
 * format defined by the driver vendor.
 */
class OpaqueDeviceConfiguration implements JsonSerializable
{
    /**
     * Driver is used to determine which kubelet plugin needs to be passed these
     * configuration parameters.
     *
     * An admission policy provided by the driver developer could use this to decide
     * whether it needs to validate them.
     *
     * Must be a DNS subdomain and should end with a DNS domain owned by the vendor of
     * the driver.
     */
    private string $driver;

    /**
     * Parameters can contain arbitrary data. It is the responsibility of the driver
     * developer to handle validation and versioning. Typically this includes
     * self-identification and a version ("kind" + "apiVersion" for Kubernetes types),
     * with conversion between different versions.
     *
     * The length of the raw data must be smaller or equal to 10 Ki.
     */
    private RawExtension $parameters;

    public function __construct(string $driver)
    {
        $this->driver = $driver;
        $this->parameters = new RawExtension();
    }

    public function getDriver(): string
    {
        return $this->driver;
    }

    public function parameters(): RawExtension
    {
        return $this->parameters;
    }

    public function setDriver(string $driver): self
    {
        $this->driver = $driver;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'driver' => $this->driver,
            'parameters' => $this->parameters,
        ]);
    }
}
