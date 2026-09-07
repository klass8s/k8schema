<?php

declare(strict_types=1);

namespace K8Schema\Api\Autoscaling\V1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * Scale represents a scaling request for a resource.
 */
class Scale implements APIResourceInterface
{
    public const string API_VERSION = 'autoscaling/v1';
    public const string KIND = 'Scale';

    /**
     * metadata is the standard object metadata; More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata.
     */
    private ObjectMeta $metadata;

    /**
     * spec defines the behavior of the scale. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status.
     */
    private ScaleSpec $spec;

    /**
     * status is the current status of the scale. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status.
     * Read-only.
     */
    private ScaleStatus|null $status = null;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new ScaleSpec();
    }

    public function getStatus(): ScaleStatus|null
    {
        return $this->status;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function setMetadata(ObjectMeta $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    public function setSpec(ScaleSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function setStatus(ScaleStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function spec(): ScaleSpec
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
            'status' => $this->status,
        ]);
    }
}
