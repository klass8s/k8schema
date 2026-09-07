<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1;

use ArrayObject;
use JsonSerializable;

/**
 * Counter describes a quantity associated with a device.
 */
class Counter implements JsonSerializable
{
    /**
     * Value defines how much of a certain device counter is available.
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

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'value' => $this->value,
        ]);
    }
}
