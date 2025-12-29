<?php

declare(strict_types=1);

namespace K8Schema\Api\Coordination\V1alpha2;

use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * LeaseCandidate defines a candidate for a Lease object. Candidates are created
 * such that coordinated leader election will pick the best leader from the list of
 * candidates.
 */
class LeaseCandidate implements APIResourceInterface
{
    public const string API_VERSION = 'coordination.k8s.io/v1alpha2';
    public const string KIND = 'LeaseCandidate';

    /**
     * More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * spec contains the specification of the Lease. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status
     */
    private LeaseCandidateSpec $spec;

    public function __construct(LeaseCandidateSpec $spec)
    {
        $this->metadata = new ObjectMeta();
        $this->spec = $spec;
    }

    public function getSpec(): LeaseCandidateSpec
    {
        return $this->spec;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function setSpec(LeaseCandidateSpec $spec): self
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
