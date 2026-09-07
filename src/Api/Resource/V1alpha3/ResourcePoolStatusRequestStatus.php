<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1alpha3;

use ArrayObject;
use JsonSerializable;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ConditionList;

/**
 * ResourcePoolStatusRequestStatus contains the calculated pool status information.
 */
class ResourcePoolStatusRequestStatus implements JsonSerializable
{
    /**
     * Conditions provide information about the state of the request. A condition with
     * type=Complete or type=Failed will always be set when the status is populated.
     *
     * Known condition types: - "Complete": True when the request has been processed
     * successfully - "Failed": True when the request could not be processed
     */
    private ConditionList $conditions;

    /**
     * PoolCount is the total number of pools that matched the filter criteria,
     * regardless of truncation. This helps users understand how many pools exist even
     * when the response is truncated. A value of 0 means no pools matched the filter
     * criteria.
     */
    private int $poolCount;

    /**
     * Pools contains the first `spec.limit` matching pools, sorted by driver then pool
     * name. If `len(pools) < poolCount`, the list was truncated. When omitted, no
     * pools matched the request filters.
     */
    private PoolStatusList $pools;

    public function __construct(int $poolCount)
    {
        $this->conditions = new ConditionList();
        $this->poolCount = $poolCount;
        $this->pools = new PoolStatusList();
    }

    public function conditions(): ConditionList
    {
        return $this->conditions;
    }

    public function getPoolCount(): int
    {
        return $this->poolCount;
    }

    public function pools(): PoolStatusList
    {
        return $this->pools;
    }

    public function setConditions(ConditionList $conditions): self
    {
        $this->conditions = $conditions;

        return $this;
    }

    public function setPoolCount(int $poolCount): self
    {
        $this->poolCount = $poolCount;

        return $this;
    }

    public function setPools(PoolStatusList $pools): self
    {
        $this->pools = $pools;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'conditions' => $this->conditions,
            'poolCount' => $this->poolCount,
            'pools' => $this->pools,
        ]);
    }
}
