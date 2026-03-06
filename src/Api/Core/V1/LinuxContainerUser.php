<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\IntList;

/**
 * LinuxContainerUser represents user identity information in Linux containers
 */
class LinuxContainerUser implements JsonSerializable
{
    /**
     * GID is the primary gid initially attached to the first process in the container
     */
    private int $gid;

    /**
     * SupplementalGroups are the supplemental groups initially attached to the first
     * process in the container
     */
    private IntList $supplementalGroups;

    /**
     * UID is the primary uid initially attached to the first process in the container
     */
    private int $uid;

    public function __construct(int $gid, int $uid)
    {
        $this->gid = $gid;
        $this->supplementalGroups = new IntList();
        $this->uid = $uid;
    }

    public function getGid(): int
    {
        return $this->gid;
    }

    public function getUid(): int
    {
        return $this->uid;
    }

    public function setGid(int $gid): self
    {
        $this->gid = $gid;

        return $this;
    }

    public function setSupplementalGroups(IntList $supplementalGroups): self
    {
        $this->supplementalGroups = $supplementalGroups;

        return $this;
    }

    public function setUid(int $uid): self
    {
        $this->uid = $uid;

        return $this;
    }

    public function supplementalGroups(): IntList
    {
        return $this->supplementalGroups;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'gid' => $this->gid,
            'supplementalGroups' => $this->supplementalGroups,
            'uid' => $this->uid,
        ]);
    }
}
