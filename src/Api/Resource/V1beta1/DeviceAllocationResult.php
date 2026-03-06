<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1beta1;

use ArrayObject;
use JsonSerializable;

/**
 * DeviceAllocationResult is the result of allocating devices.
 */
class DeviceAllocationResult implements JsonSerializable
{
    /**
     * This field is a combination of all the claim and class configuration parameters.
     * Drivers can distinguish between those based on a flag.
     *
     * This includes configuration parameters for drivers which have no allocated
     * devices in the result because it is up to the drivers which configuration
     * parameters they support. They can silently ignore unknown configuration
     * parameters.
     */
    private DeviceAllocationConfigurationList $config;

    /**
     * Results lists all allocated devices.
     */
    private DeviceRequestAllocationResultList $results;

    public function __construct()
    {
        $this->config = new DeviceAllocationConfigurationList();
        $this->results = new DeviceRequestAllocationResultList();
    }

    public function config(): DeviceAllocationConfigurationList
    {
        return $this->config;
    }

    public function results(): DeviceRequestAllocationResultList
    {
        return $this->results;
    }

    public function setConfig(DeviceAllocationConfigurationList $config): self
    {
        $this->config = $config;

        return $this;
    }

    public function setResults(DeviceRequestAllocationResultList $results): self
    {
        $this->results = $results;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'config' => $this->config,
            'results' => $this->results,
        ]);
    }
}
