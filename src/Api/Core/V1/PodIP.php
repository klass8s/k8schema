<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * PodIP represents a single IP address allocated to the pod.
 */
class PodIP implements JsonSerializable
{
    /**
     * IP is the IP address assigned to the pod
     */
    private string $ip;

    public function __construct(string $ip)
    {
        $this->ip = $ip;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'ip' => $this->ip,
        ]);
    }
}
