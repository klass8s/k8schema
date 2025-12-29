<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1beta1;

use JsonSerializable;

/**
 * DeviceCapacity describes a quantity associated with a device.
 */
class DeviceCapacity implements JsonSerializable
{
    /**
     * Value defines how much of a certain device capacity is available.
     */
    private string|float $value;

    public function __construct(string|float $value)
    {
        $this->value = $value;
    }

    public function getValue(): string|float
    {
        return $this->value;
    }

    public function setValue(string|float $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'value' => $this->value,
        ];
    }
}
