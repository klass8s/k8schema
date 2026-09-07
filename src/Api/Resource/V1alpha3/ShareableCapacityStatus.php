<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1alpha3;

use ArrayObject;
use JsonSerializable;

/**
 * ShareableCapacityStatus reports aggregate amounts for a single shareable
 * capacity key.
 */
class ShareableCapacityStatus implements JsonSerializable
{
    /**
     * Available is Total minus Consumed, never negative.
     */
    private string|float $available;

    /**
     * Consumed is the amount drawn by current allocations.
     */
    private string|float $consumed;

    /**
     * Name is the capacity name.
     */
    private string $name;

    /**
     * Total is the sum of this capacity across shareable devices in the pool.
     */
    private string|float $total;

    public function __construct(string|float $available, string|float $consumed, string $name, string|float $total)
    {
        $this->available = $available;
        $this->consumed = $consumed;
        $this->name = $name;
        $this->total = $total;
    }

    public function getAvailable(): string|float
    {
        return $this->available;
    }

    public function getConsumed(): string|float
    {
        return $this->consumed;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTotal(): string|float
    {
        return $this->total;
    }

    public function setAvailable(string|float $available): self
    {
        $this->available = $available;

        return $this;
    }

    public function setConsumed(string|float $consumed): self
    {
        $this->consumed = $consumed;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setTotal(string|float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'available' => $this->available,
            'consumed' => $this->consumed,
            'name' => $this->name,
            'total' => $this->total,
        ]);
    }
}
