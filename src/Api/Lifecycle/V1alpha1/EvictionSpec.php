<?php

declare(strict_types=1);

namespace K8Schema\Api\Lifecycle\V1alpha1;

use ArrayObject;
use JsonSerializable;

/**
 * EvictionSpec is a specification of an Eviction.
 */
class EvictionSpec implements JsonSerializable
{
    /**
     * target contains a reference to an object (e.g. a pod) that should be evicted.
     * This field is required and immutable.
     */
    private EvictionTarget $target;

    public function __construct()
    {
        $this->target = new EvictionTarget();
    }

    public function setTarget(EvictionTarget $target): self
    {
        $this->target = $target;

        return $this;
    }

    public function target(): EvictionTarget
    {
        return $this->target;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'target' => $this->target,
        ]);
    }
}
