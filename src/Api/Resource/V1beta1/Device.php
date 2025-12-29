<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1beta1;

use JsonSerializable;

/**
 * Device represents one individual hardware instance that can be selected based on
 * its attributes. Besides the name, exactly one field must be set.
 */
class Device implements JsonSerializable
{
    /**
     * Basic defines one device instance.
     */
    private BasicDevice $basic;

    /**
     * Name is unique identifier among all devices managed by the driver in the pool.
     * It must be a DNS label.
     */
    private string $name;

    public function __construct(string $name)
    {
        $this->basic = new BasicDevice();
        $this->name = $name;
    }

    public function basic(): BasicDevice
    {
        return $this->basic;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'basic' => $this->basic,
            'name' => $this->name,
        ];
    }
}
