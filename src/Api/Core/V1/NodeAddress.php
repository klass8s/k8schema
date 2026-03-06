<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * NodeAddress contains information for the node's address.
 */
class NodeAddress implements JsonSerializable
{
    /**
     * The node address.
     */
    private string $address;

    /**
     * Node address type, one of Hostname, ExternalIP or InternalIP.
     */
    private string $type;

    public function __construct(string $address, string $type)
    {
        $this->address = $address;
        $this->type = $type;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'address' => $this->address,
            'type' => $this->type,
        ]);
    }
}
