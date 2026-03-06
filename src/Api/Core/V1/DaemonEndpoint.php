<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * DaemonEndpoint contains information about a single Daemon endpoint.
 */
class DaemonEndpoint implements JsonSerializable
{
    /**
     * Port number of the given endpoint.
     */
    private int $Port;

    public function __construct(int $Port)
    {
        $this->Port = $Port;
    }

    public function getPort(): int
    {
        return $this->Port;
    }

    public function setPort(int $Port): self
    {
        $this->Port = $Port;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'Port' => $this->Port,
        ]);
    }
}
