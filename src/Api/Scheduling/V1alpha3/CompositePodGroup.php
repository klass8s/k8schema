<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1alpha3;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * CompositePodGroup represents a runtime instance of pod groups grouped together.
 * CompositePodGroups are created by workload controllers (LWS, JobSet, etc...)
 * from Workload.compositePodGroupTemplates. CompositePodGroup API enablement is
 * toggled by the CompositePodGroup feature gate.
 */
class CompositePodGroup implements APIResourceInterface
{
    public const string API_VERSION = 'scheduling.k8s.io/v1alpha3';
    public const string KIND = 'CompositePodGroup';

    /**
     * metadata is the standard object metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * spec defines the desired state of the CompositePodGroup.
     */
    private CompositePodGroupSpec $spec;

    /**
     * status represents the current observed state of the CompositePodGroup.
     */
    private CompositePodGroupStatus|null $status = null;

    public function __construct(CompositePodGroupSpec $spec)
    {
        $this->metadata = new ObjectMeta();
        $this->spec = $spec;
    }

    public function getSpec(): CompositePodGroupSpec
    {
        return $this->spec;
    }

    public function getStatus(): CompositePodGroupStatus|null
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

    public function setSpec(CompositePodGroupSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function setStatus(CompositePodGroupStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function status(): CompositePodGroupStatus
    {
        return $this->status ??= new CompositePodGroupStatus();
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
