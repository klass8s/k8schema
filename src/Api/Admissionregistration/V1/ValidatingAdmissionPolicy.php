<?php

declare(strict_types=1);

namespace K8Schema\Api\Admissionregistration\V1;

use ArrayObject;
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
     * metadata is the standard object metadata; More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata.
     */
    private ObjectMeta $metadata;

    /**
     * spec defines the desired behavior of the ValidatingAdmissionPolicy.
     */
    private ValidatingAdmissionPolicySpec $spec;

    /**
     * status represents the current status of the ValidatingAdmissionPolicy, including
     * warnings that are useful to determine if the policy behaves in the expected way.
     * Populated by the system. Read-only.
     */
    private ValidatingAdmissionPolicyStatus|null $status = null;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new ValidatingAdmissionPolicySpec();
    }

    public function getStatus(): ValidatingAdmissionPolicyStatus|null
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

    public function setSpec(ValidatingAdmissionPolicySpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function setStatus(ValidatingAdmissionPolicyStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function spec(): ValidatingAdmissionPolicySpec
    {
        return $this->spec;
    }

    public function status(): ValidatingAdmissionPolicyStatus
    {
        return $this->status ??= new ValidatingAdmissionPolicyStatus();
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
