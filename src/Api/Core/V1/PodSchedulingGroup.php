<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * PodSchedulingGroup identifies the runtime scheduling group instance that a Pod
 * belongs to. The scheduler uses this information to apply workload-aware
 * scheduling semantics. Exactly one field must be specified.
 */
class PodSchedulingGroup implements JsonSerializable
{
    /**
     * PodGroupName specifies the name of the standalone PodGroup object that
     * represents the runtime instance of this group. Must be a DNS subdomain.
     */
    private string|null $podGroupName = null;

    public function __construct()
    {
    }

    public function getPodGroupName(): string|null
    {
        return $this->podGroupName;
    }

    public function setPodGroupName(string $podGroupName): self
    {
        $this->podGroupName = $podGroupName;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'podGroupName' => $this->podGroupName,
        ]);
    }
}
