<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * AttachedVolume describes a volume attached to a node
 */
class AttachedVolume implements JsonSerializable
{
    /**
     * DevicePath represents the device path where the volume should be available
     */
    private string $devicePath;

    /**
     * Name of the attached volume
     */
    private string $name;

    public function __construct(string $devicePath, string $name)
    {
        $this->devicePath = $devicePath;
        $this->name = $name;
    }

    public function getDevicePath(): string
    {
        return $this->devicePath;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setDevicePath(string $devicePath): self
    {
        $this->devicePath = $devicePath;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'devicePath' => $this->devicePath,
            'name' => $this->name,
        ]);
    }
}
