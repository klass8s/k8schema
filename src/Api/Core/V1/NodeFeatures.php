<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * NodeFeatures describes the set of features implemented by the CRI
 * implementation. The features contained in the NodeFeatures should depend only on
 * the cri implementation independent of runtime handlers.
 */
class NodeFeatures implements JsonSerializable
{
    /**
     * SupplementalGroupsPolicy is set to true if the runtime supports
     * SupplementalGroupsPolicy and ContainerUser.
     */
    private bool|null $supplementalGroupsPolicy = null;

    public function __construct()
    {
    }

    public function getSupplementalGroupsPolicy(): bool|null
    {
        return $this->supplementalGroupsPolicy;
    }

    public function setSupplementalGroupsPolicy(bool $supplementalGroupsPolicy): self
    {
        $this->supplementalGroupsPolicy = $supplementalGroupsPolicy;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'supplementalGroupsPolicy' => $this->supplementalGroupsPolicy,
        ]);
    }
}
