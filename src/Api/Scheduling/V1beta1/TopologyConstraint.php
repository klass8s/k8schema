<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1beta1;

use ArrayObject;
use JsonSerializable;

/**
 * TopologyConstraint defines a topology constraint for a PodGroup.
 */
class TopologyConstraint implements JsonSerializable
{
    /**
     * key specifies the key of the node label representing the topology domain. All
     * pods within the PodGroup must be colocated within the same domain instance.
     * Different PodGroups can land on different domain instances even if they derive
     * from the same PodGroupTemplate. Examples: "topology.kubernetes.io/rack"
     */
    private string $key;

    public function __construct(string $key)
    {
        $this->key = $key;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function setKey(string $key): self
    {
        $this->key = $key;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'key' => $this->key,
        ]);
    }
}
