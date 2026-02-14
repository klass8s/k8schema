<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1beta2;

use ArrayObject;
use JsonSerializable;

/**
 * ResourcePool describes the pool that ResourceSlices belong to.
 */
class ResourcePool implements JsonSerializable
{
    /**
     * Generation tracks the change in a pool over time. Whenever a driver changes
     * something about one or more of the resources in a pool, it must change the
     * generation in all ResourceSlices which are part of that pool. Consumers of
     * ResourceSlices should only consider resources from the pool with the highest
     * generation number. The generation may be reset by drivers, which should be fine
     * for consumers, assuming that all ResourceSlices in a pool are updated to match
     * or deleted.
     *
     * Combined with ResourceSliceCount, this mechanism enables consumers to detect
     * pools which are comprised of multiple ResourceSlices and are in an incomplete
     * state.
     */
    private int $generation;

    /**
     * Name is used to identify the pool. For node-local devices, this is often the
     * node name, but this is not required.
     *
     * It must not be longer than 253 characters and must consist of one or more DNS
     * sub-domains separated by slashes. This field is immutable.
     */
    private string $name;

    /**
     * ResourceSliceCount is the total number of ResourceSlices in the pool at this
     * generation number. Must be greater than zero.
     *
     * Consumers can use this to check whether they have seen all ResourceSlices
     * belonging to the same pool.
     */
    private int $resourceSliceCount;

    public function __construct(int $generation, string $name, int $resourceSliceCount)
    {
        $this->generation = $generation;
        $this->name = $name;
        $this->resourceSliceCount = $resourceSliceCount;
    }

    public function getGeneration(): int
    {
        return $this->generation;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getResourceSliceCount(): int
    {
        return $this->resourceSliceCount;
    }

    public function setGeneration(int $generation): self
    {
        $this->generation = $generation;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setResourceSliceCount(int $resourceSliceCount): self
    {
        $this->resourceSliceCount = $resourceSliceCount;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'generation' => $this->generation,
            'name' => $this->name,
            'resourceSliceCount' => $this->resourceSliceCount,
        ]);
    }
}
