<?php

declare(strict_types=1);

namespace K8Schema\Api\Lifecycle\V1alpha1;

use ArrayObject;
use JsonSerializable;

/**
 * EvictionRequestPodReference contains enough information to locate the referenced
 * pod inside the same namespace.
 */
class EvictionRequestPodReference implements JsonSerializable
{
    /**
     * name of the target. This field is required.
     */
    private string $name;

    /**
     * uid of the target. It can be found in .metadata.uid of the target and is a
     * lowercase UUID in 8-4-4-4-12 format. This field is required.
     */
    private string $uid;

    public function __construct(string $name, string $uid)
    {
        $this->name = $name;
        $this->uid = $uid;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUid(): string
    {
        return $this->uid;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setUid(string $uid): self
    {
        $this->uid = $uid;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'name' => $this->name,
            'uid' => $this->uid,
        ]);
    }
}
