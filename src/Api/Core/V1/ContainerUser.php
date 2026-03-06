<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * ContainerUser represents user identity information
 */
class ContainerUser implements JsonSerializable
{
    /**
     * Linux holds user identity information initially attached to the first process of
     * the containers in Linux. Note that the actual running identity can be changed if
     * the process has enough privilege to do so.
     */
    private LinuxContainerUser|null $linux = null;

    public function __construct()
    {
    }

    public function getLinux(): LinuxContainerUser|null
    {
        return $this->linux;
    }

    public function setLinux(LinuxContainerUser $linux): self
    {
        $this->linux = $linux;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'linux' => $this->linux,
        ]);
    }
}
