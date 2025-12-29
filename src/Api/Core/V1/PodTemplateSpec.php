<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use JsonSerializable;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * PodTemplateSpec describes the data a pod should have when created from a
 * template
 */
class PodTemplateSpec implements JsonSerializable
{
    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * Specification of the desired behavior of the pod. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status
     */
    private PodSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new PodSpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function spec(): PodSpec
    {
        return $this->spec;
    }

    public function jsonSerialize(): array
    {
        return [
            'metadata' => $this->metadata,
            'spec' => $this->spec,
        ];
    }
}
