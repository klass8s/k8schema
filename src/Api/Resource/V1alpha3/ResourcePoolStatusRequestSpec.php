<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1alpha3;

use ArrayObject;
use JsonSerializable;

/**
 * ResourcePoolStatusRequestSpec defines the filters for the pool status request.
 */
class ResourcePoolStatusRequestSpec implements JsonSerializable
{
    /**
     * Driver specifies the DRA driver name to filter pools. Only pools from
     * ResourceSlices with this driver will be included. Must be a DNS subdomain (e.g.,
     * "gpu.example.com").
     */
    private string $driver;

    /**
     * Limit optionally specifies the maximum number of pools to return in the status.
     * If more pools match the filter criteria, the response will be truncated (i.e.,
     * len(status.pools) < status.poolCount).
     *
     * Default: 100 Minimum: 1 Maximum: 1000
     */
    private int|null $limit = null;

    /**
     * PoolName optionally filters to a specific pool name. If not specified, all pools
     * from the specified driver are included. When specified, must be a non-empty
     * valid resource pool name (DNS subdomains separated by "/").
     */
    private string|null $poolName = null;

    public function __construct(string $driver)
    {
        $this->driver = $driver;
    }

    public function getDriver(): string
    {
        return $this->driver;
    }

    public function getLimit(): int|null
    {
        return $this->limit;
    }

    public function getPoolName(): string|null
    {
        return $this->poolName;
    }

    public function setDriver(string $driver): self
    {
        $this->driver = $driver;

        return $this;
    }

    public function setLimit(int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

    public function setPoolName(string $poolName): self
    {
        $this->poolName = $poolName;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'driver' => $this->driver,
            'limit' => $this->limit,
            'poolName' => $this->poolName,
        ]);
    }
}
