<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1alpha2;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * PodGroup represents a runtime instance of pods grouped together. PodGroups are
 * created by workload controllers (Job, LWS, JobSet, etc...) from
 * Workload.podGroupTemplates. PodGroup API enablement is toggled by the
 * GenericWorkload feature gate.
 */
class PodGroup implements APIResourceInterface
{
    public const string API_VERSION = 'scheduling.k8s.io/v1alpha2';
    public const string KIND = 'PodGroup';

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * Spec defines the desired state of the PodGroup.
     */
    private PodGroupSpec $spec;

    /**
     * Status represents the current observed state of the PodGroup.
     */
    private PodGroupStatus|null $status = null;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new PodGroupSpec();
    }

    public function getStatus(): PodGroupStatus|null
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

    public function setSpec(PodGroupSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function setStatus(PodGroupStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function spec(): PodGroupSpec
    {
        return $this->spec;
    }

    public function status(): PodGroupStatus
    {
        return $this->status ??= new PodGroupStatus();
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
