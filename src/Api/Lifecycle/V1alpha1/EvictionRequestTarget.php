<?php

declare(strict_types=1);

namespace K8Schema\Api\Lifecycle\V1alpha1;

use ArrayObject;
use JsonSerializable;

/**
 * EvictionRequestTarget contains a reference to an object that should be evicted.
 */
class EvictionRequestTarget implements JsonSerializable
{
    /**
     * pod references a pod that is subject to eviction/termination. Pods that are part
     * of a PodGroup (.spec.schedulingGroup is set) are not supported.
     */
    private EvictionRequestPodReference|null $pod = null;

    public function __construct()
    {
    }

    public function getPod(): EvictionRequestPodReference|null
    {
        return $this->pod;
    }

    public function setPod(EvictionRequestPodReference $pod): self
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
