<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * ResourceSlice represents one or more resources in a pool of similar resources,
 * managed by a common driver. A pool may span more than one ResourceSlice, and
 * exactly how many ResourceSlices comprise a pool is determined by the driver.
 *
 * At the moment, the only supported resources are devices with attributes and
 * capacities. Each device in a given pool, regardless of how many ResourceSlices,
 * must have a unique name. The ResourceSlice in which a device gets published may
 * change over time. The unique identifier for a device is the tuple <driver name>,
 * <pool name>, <device name>.
 *
 * Whenever a driver needs to update a pool, it increments the
 * pool.Spec.Pool.Generation number and updates all ResourceSlices with that new
 * number and new resource definitions. A consumer must only use ResourceSlices
 * with the highest generation number and ignore all others.
 *
 * When allocating all resources in a pool matching certain criteria or when
 * looking for the best solution among several different alternatives, a consumer
 * should check the number of ResourceSlices in a pool (included in each
 * ResourceSlice) to determine whether its view of a pool is complete and if not,
 * should wait until the driver has completed updating the pool.
 *
 * For resources that are not local to a node, the node name is not set. Instead,
 * the driver may use a node selector to specify where the devices are available.
 *
 * This is an alpha type and requires enabling the DynamicResourceAllocation
 * feature gate.
 */
class ResourceSlice implements APIResourceInterface
{
    public const string API_VERSION = 'resource.k8s.io/v1';
    public const string KIND = 'ResourceSlice';

    /**
     * Standard object metadata
     */
    private ObjectMeta $metadata;

    /**
     * Contains the information published by the driver.
     *
     * Changing the spec automatically increments the metadata.generation number.
     */
    private ResourceSliceSpec $spec;

    public function __construct(ResourceSliceSpec $spec)
    {
        $this->metadata = new ObjectMeta();
        $this->spec = $spec;
    }

    public function getSpec(): ResourceSliceSpec
    {
        return $this->spec;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function setSpec(ResourceSliceSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'metadata' => $this->metadata,
            'spec' => $this->spec,
        ]);
    }
}
