<?php

declare(strict_types=1);

namespace K8Schema\Api\Flowcontrol\V1;

use ArrayObject;
use JsonSerializable;

/**
 * PriorityLevelConfigurationReference contains information that points to the
 * "request-priority" being used.
 */
class PriorityLevelConfigurationReference implements JsonSerializable
{
    /**
     * `name` is the name of the priority level configuration being referenced
     * Required.
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
