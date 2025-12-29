<?php

declare(strict_types=1);

namespace K8Schema\Api\Autoscaling\V2;

use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * HorizontalPodAutoscaler is the configuration for a horizontal pod autoscaler,
 * which automatically manages the replica count of any resource implementing the
 * scale subresource based on the metrics specified.
 */
class HorizontalPodAutoscaler implements APIResourceInterface
{
    public const string API_VERSION = 'autoscaling/v2';
    public const string KIND = 'HorizontalPodAutoscaler';

    /**
     * metadata is the standard object metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * spec is the specification for the behaviour of the autoscaler. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status.
     */
    private HorizontalPodAutoscalerSpec $spec;

    public function __construct(HorizontalPodAutoscalerSpec $spec)
    {
        $this->metadata = new ObjectMeta();
        $this->spec = $spec;
    }

    public function getSpec(): HorizontalPodAutoscalerSpec
    {
        return $this->spec;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function setSpec(HorizontalPodAutoscalerSpec $spec): self
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
