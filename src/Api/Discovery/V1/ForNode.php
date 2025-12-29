<?php

declare(strict_types=1);

namespace K8Schema\Api\Discovery\V1;

use JsonSerializable;

/**
 * ForNode provides information about which nodes should consume this endpoint.
 */
class ForNode implements JsonSerializable
{
    /**
     * name represents the name of the node.
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

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
