<?php

declare(strict_types=1);

namespace K8Schema\Api\Flowcontrol\V1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * PriorityLevelConfiguration represents the configuration of a priority level.
 */
class PriorityLevelConfiguration implements APIResourceInterface
{
    public const string API_VERSION = 'flowcontrol.apiserver.k8s.io/v1';
    public const string KIND = 'PriorityLevelConfiguration';

    /**
     * `metadata` is the standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * `spec` is the specification of the desired behavior of a "request-priority".
     * More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status
     */
    private PriorityLevelConfigurationSpec $spec;

    /**
     * `status` is the current status of a "request-priority". More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status
     */
    private PriorityLevelConfigurationStatus|null $status = null;

    public function __construct(PriorityLevelConfigurationSpec $spec)
    {
        $this->metadata = new ObjectMeta();
        $this->spec = $spec;
    }

    public function getSpec(): PriorityLevelConfigurationSpec
    {
        return $this->spec;
    }

    public function getStatus(): PriorityLevelConfigurationStatus|null
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

    public function setSpec(PriorityLevelConfigurationSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function setStatus(PriorityLevelConfigurationStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function status(): PriorityLevelConfigurationStatus
    {
        return $this->status ??= new PriorityLevelConfigurationStatus();
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
