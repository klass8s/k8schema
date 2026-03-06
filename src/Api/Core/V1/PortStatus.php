<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * PortStatus represents the error condition of a service port
 */
class PortStatus implements JsonSerializable
{
    /**
     * Error is to record the problem with the service port The format of the error
     * shall comply with the following rules: - built-in error values shall be
     * specified in this file and those shall use
     *   CamelCase names
     * - cloud provider specific error values must have names that comply with the
     *   format foo.example.com/CamelCase.
     */
    private string|null $error = null;

    /**
     * Port is the port number of the service port of which status is recorded here
     */
    private int $port;

    /**
     * Protocol is the protocol of the service port of which status is recorded here
     * The supported values are: "TCP", "UDP", "SCTP"
     */
    private string $protocol;

    public function __construct(int $port, string $protocol)
    {
        $this->port = $port;
        $this->protocol = $protocol;
    }

    public function getError(): string|null
    {
        return $this->error;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function getProtocol(): string
    {
        return $this->protocol;
    }

    public function setError(string $error): self
    {
        $this->error = $error;

        return $this;
    }

    public function setPort(int $port): self
    {
        $this->port = $port;

        return $this;
    }

    public function setProtocol(string $protocol): self
    {
        $this->protocol = $protocol;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'error' => $this->error,
            'port' => $this->port,
            'protocol' => $this->protocol,
        ]);
    }
}
