<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringList;

/**
 * HostAlias holds the mapping between IP and hostnames that will be injected as an
 * entry in the pod's hosts file.
 */
class HostAlias implements JsonSerializable
{
    /**
     * Hostnames for the above IP address.
     */
    private StringList $hostnames;

    /**
     * IP address of the host file entry.
     */
    private string $ip;

    public function __construct(string $ip)
    {
        $this->hostnames = new StringList();
        $this->ip = $ip;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function hostnames(): StringList
    {
        return $this->hostnames;
    }

    public function setHostnames(StringList $hostnames): self
    {
        $this->hostnames = $hostnames;

        return $this;
    }

    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'hostnames' => $this->hostnames,
            'ip' => $this->ip,
        ]);
    }
}
