<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * NodeSwapStatus represents swap memory information.
 */
class NodeSwapStatus implements JsonSerializable
{
    /**
     * Total amount of swap memory in bytes.
     */
    private int|null $capacity = null;

    public function __construct()
    {
    }

    public function getCapacity(): int|null
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'capacity' => $this->capacity,
        ]);
    }
}
