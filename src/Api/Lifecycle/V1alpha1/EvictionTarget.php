<?php

declare(strict_types=1);

namespace K8Schema\Api\Lifecycle\V1alpha1;

use ArrayObject;
use JsonSerializable;

/**
 * EvictionTarget contains a reference to an object that should be evicted.
 */
class EvictionTarget implements JsonSerializable
{
    /**
     * pod references a pod that is subject to eviction/termination. Pods that are part
     * of a PodGroup (.spec.schedulingGroup is set) are not supported.
     */
    private EvictionPodReference|null $pod = null;

    public function __construct()
    {
    }

    public function getPod(): EvictionPodReference|null
    {
        return $this->pod;
    }

    public function setPod(EvictionPodReference $pod): self
    {
        $this->pod = $pod;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'pod' => $this->pod,
        ]);
    }
}
