<?php

declare(strict_types=1);

namespace K8Schema\Api\Admissionregistration\V1;

use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * ValidatingAdmissionPolicy describes the definition of an admission validation
 * policy that accepts or rejects an object without changing it.
 */
class ValidatingAdmissionPolicy implements APIResourceInterface
{
    public const string API_VERSION = 'admissionregistration.k8s.io/v1';
    public const string KIND = 'ValidatingAdmissionPolicy';

    /**
     * Standard object metadata; More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata.
     */
    private ObjectMeta $metadata;

    /**
     * Specification of the desired behavior of the ValidatingAdmissionPolicy.
     */
    private ValidatingAdmissionPolicySpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new ValidatingAdmissionPolicySpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function spec(): ValidatingAdmissionPolicySpec
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
