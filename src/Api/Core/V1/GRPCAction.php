<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * GRPCAction specifies an action involving a GRPC service.
 */
class GRPCAction implements JsonSerializable
{
    /**
     * mode specifies the connection mode for the gRPC health probe. Set to "TLS" to
     * use TLS without certificate verification. Set to "Plaintext" to use a plaintext
     * (insecure) connection explicitly. If not specified, the probe uses a plaintext
     * (insecure) connection.
     */
    private string|null $mode = null;

    /**
     * Port number of the gRPC service. Number must be in the range 1 to 65535.
     */
    private int $port;

    /**
     * Service is the name of the service to place in the gRPC HealthCheckRequest (see
     * https://github.com/grpc/grpc/blob/master/doc/health-checking.md).
     *
     * If this is not specified, the default behavior is defined by gRPC.
     */
    private string|null $service = null;

    public function __construct(int $port)
    {
        $this->port = $port;
    }

    public function getMode(): string|null
    {
        return $this->mode;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function getService(): string|null
    {
        return $this->service;
    }

    public function setMode(string $mode): self
    {
        $this->mode = $mode;

        return $this;
    }

    public function setPort(int $port): self
    {
        $this->port = $port;

        return $this;
    }

    public function setService(string $service): self
    {
        $this->service = $service;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'mode' => $this->mode,
            'port' => $this->port,
            'service' => $this->service,
        ]);
    }
}
