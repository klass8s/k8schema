<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * PodSchedulingGate is associated to a Pod to guard its scheduling.
 */
class PodSchedulingGate implements JsonSerializable
{
    /**
     * Name of the scheduling gate. Each scheduling gate must have a unique name field.
     */
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
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

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'name' => $this->name,
        ]);
    }
}
