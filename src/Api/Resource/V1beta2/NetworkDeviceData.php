<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1beta2;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringList;

/**
 * NetworkDeviceData provides network-related details for the allocated device.
 * This information may be filled by drivers or other components to configure or
 * identify the device within a network context.
 */
class NetworkDeviceData implements JsonSerializable
{
    /**
     * HardwareAddress represents the hardware address (e.g. MAC Address) of the
     * device's network interface.
     *
     * Must not be longer than 128 characters.
     */
    private string|null $hardwareAddress = null;

    /**
     * InterfaceName specifies the name of the network interface associated with the
     * allocated device. This might be the name of a physical or virtual network
     * interface being configured in the pod.
     *
     * Must not be longer than 256 characters.
     */
    private string|null $interfaceName = null;

    /**
     * IPs lists the network addresses assigned to the device's network interface. This
     * can include both IPv4 and IPv6 addresses. The IPs are in the CIDR notation,
     * which includes both the address and the associated subnet mask. e.g.:
     * "192.0.2.5/24" for IPv4 and "2001:db8::5/64" for IPv6.
     */
    private StringList $ips;

    public function __construct()
    {
        $this->ips = new StringList();
    }

    public function getHardwareAddress(): string|null
    {
        return $this->hardwareAddress;
    }

    public function getInterfaceName(): string|null
    {
        return $this->interfaceName;
    }

    public function ips(): StringList
    {
        return $this->ips;
    }

    public function setHardwareAddress(string $hardwareAddress): self
    {
        $this->hardwareAddress = $hardwareAddress;

        return $this;
    }

    public function setInterfaceName(string $interfaceName): self
    {
        $this->interfaceName = $interfaceName;

        return $this;
    }

    public function setIps(StringList $ips): self
    {
        $this->ips = $ips;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'hardwareAddress' => $this->hardwareAddress,
            'interfaceName' => $this->interfaceName,
            'ips' => $this->ips,
        ]);
    }
}
