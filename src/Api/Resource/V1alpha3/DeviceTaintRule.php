<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1alpha3;

use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * DeviceTaintRule adds one taint to all devices which match the selector. This has
 * the same effect as if the taint was specified directly in the ResourceSlice by
 * the DRA driver.
 */
class DeviceTaintRule implements APIResourceInterface
{
    public const string API_VERSION = 'resource.k8s.io/v1alpha3';
    public const string KIND = 'DeviceTaintRule';

    /**
     * Standard object metadata
     */
    private ObjectMeta $metadata;

    /**
     * Spec specifies the selector and one taint.
     *
     * Changing the spec automatically increments the metadata.generation number.
     */
    private DeviceTaintRuleSpec $spec;

    public function __construct(DeviceTaintRuleSpec $spec)
    {
        $this->metadata = new ObjectMeta();
        $this->spec = $spec;
    }

    public function getSpec(): DeviceTaintRuleSpec
    {
        return $this->spec;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function setSpec(DeviceTaintRuleSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'metadata' => $this->metadata,
            'spec' => $this->spec,
        ];
    }
}
