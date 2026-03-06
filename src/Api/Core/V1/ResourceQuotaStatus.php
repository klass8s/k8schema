<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringOrFloatMap;

/**
 * ResourceQuotaStatus defines the enforced hard limits and observed use.
 */
class ResourceQuotaStatus implements JsonSerializable
{
    /**
     * Hard is the set of enforced hard limits for each named resource. More info:
     * https://kubernetes.io/docs/concepts/policy/resource-quotas/
     */
    private StringOrFloatMap $hard;

    /**
     * Used is the current observed total usage of the resource in the namespace.
     */
    private StringOrFloatMap $used;

    public function __construct()
    {
        $this->hard = new StringOrFloatMap();
        $this->used = new StringOrFloatMap();
    }

    public function hard(): StringOrFloatMap
    {
        return $this->hard;
    }

    public function setHard(StringOrFloatMap $hard): self
    {
        $this->hard = $hard;

        return $this;
    }

    public function setUsed(StringOrFloatMap $used): self
    {
        $this->used = $used;

        return $this;
    }

    public function used(): StringOrFloatMap
    {
        return $this->used;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'hard' => $this->hard,
            'used' => $this->used,
        ]);
    }
}
