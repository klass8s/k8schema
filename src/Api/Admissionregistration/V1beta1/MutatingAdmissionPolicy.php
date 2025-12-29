<?php

declare(strict_types=1);

namespace K8Schema\Api\Admissionregistration\V1beta1;

use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * MutatingAdmissionPolicy describes the definition of an admission mutation policy
 * that mutates the object coming into admission chain.
 */
class MutatingAdmissionPolicy implements APIResourceInterface
{
    public const string API_VERSION = 'admissionregistration.k8s.io/v1beta1';
    public const string KIND = 'MutatingAdmissionPolicy';

    /**
     * Standard object metadata; More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata.
     */
    private ObjectMeta $metadata;

    /**
     * Specification of the desired behavior of the MutatingAdmissionPolicy.
     */
    private MutatingAdmissionPolicySpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new MutatingAdmissionPolicySpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function spec(): MutatingAdmissionPolicySpec
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
