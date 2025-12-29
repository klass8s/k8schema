<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1alpha1;

use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * Workload allows for expressing scheduling constraints that should be used when
 * managing lifecycle of workloads from scheduling perspective, including
 * scheduling, preemption, eviction and other phases.
 */
class Workload implements APIResourceInterface
{
    public const string API_VERSION = 'scheduling.k8s.io/v1alpha1';
    public const string KIND = 'Workload';

    /**
     * Standard object's metadata. Name must be a DNS subdomain.
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

    public function spec(): WorkloadSpec
    {
        return $this->spec;
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
