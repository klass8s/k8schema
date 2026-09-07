<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1alpha2;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * Workload allows for expressing scheduling constraints that should be used when
 * managing the lifecycle of workloads from the scheduling perspective, including
 * scheduling, preemption, eviction and other phases. Workload API enablement is
 * toggled by the GenericWorkload feature gate.
 */
class Workload implements APIResourceInterface
{
    public const string API_VERSION = 'scheduling.k8s.io/v1alpha2';
    public const string KIND = 'Workload';

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * Spec defines the desired behavior of a Workload.
     */
    private WorkloadSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new WorkloadSpec();
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

    public function setSpec(WorkloadSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function spec(): WorkloadSpec
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
