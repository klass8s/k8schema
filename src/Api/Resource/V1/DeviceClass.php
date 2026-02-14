<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * DeviceClass is a vendor- or admin-provided resource that contains device
 * configuration and selectors. It can be referenced in the device requests of a
 * claim to apply these presets. Cluster scoped.
 *
 * This is an alpha type and requires enabling the DynamicResourceAllocation
 * feature gate.
 */
class DeviceClass implements APIResourceInterface
{
    public const string API_VERSION = 'resource.k8s.io/v1';
    public const string KIND = 'DeviceClass';

    /**
     * Standard object metadata
     */
    private ObjectMeta $metadata;

    /**
     * Spec defines what can be allocated and how to configure it.
     *
     * This is mutable. Consumers have to be prepared for classes changing at any time,
     * either because they get updated or replaced. Claim allocations are done once
     * based on whatever was set in classes at the time of allocation.
     *
     * Changing the spec automatically increments the metadata.generation number.
     */
    private DeviceClassSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new DeviceClassSpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function spec(): DeviceClassSpec
    {
        return $this->spec;
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
