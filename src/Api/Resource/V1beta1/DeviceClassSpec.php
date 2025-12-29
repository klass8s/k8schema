<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1beta1;

use JsonSerializable;

/**
 * DeviceClassSpec is used in a [DeviceClass] to define what can be allocated and
 * how to configure it.
 */
class DeviceClassSpec implements JsonSerializable
{
    /**
     * Config defines configuration parameters that apply to each device that is
     * claimed via this class. Some classses may potentially be satisfied by multiple
     * drivers, so each instance of a vendor configuration applies to exactly one
     * driver.
     *
     * They are passed to the driver, but are not considered while allocating the
     * claim.
     */
    private DeviceClassConfigurationList $config;

    /**
     * Each selector must be satisfied by a device which is claimed via this class.
     */
    private DeviceSelectorList $selectors;

    public function __construct()
    {
        $this->config = new DeviceClassConfigurationList();
        $this->selectors = new DeviceSelectorList();
    }

    public function config(): DeviceClassConfigurationList
    {
        return $this->config;
    }

    public function selectors(): DeviceSelectorList
    {
        return $this->selectors;
    }

    public function jsonSerialize(): array
    {
        return [
            'config' => $this->config,
            'selectors' => $this->selectors,
        ];
    }
}
