<?php

declare(strict_types=1);

namespace K8Schema\Api\Admissionregistration\V1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * ValidatingAdmissionPolicyBinding binds the ValidatingAdmissionPolicy with
 * paramerized resources. ValidatingAdmissionPolicyBinding and parameter CRDs
 * together define how cluster administrators configure policies for clusters.
 *
 * For a given admission request, each binding will cause its policy to be
 * evaluated N times, where N is 1 for policies/bindings that don't use params,
 * otherwise N is the number of parameters selected by the binding.
 *
 * The CEL expressions of a policy must have a computed CEL cost below the maximum
 * CEL budget. Each evaluation of the policy is given an independent CEL cost
 * budget. Adding/removing policies, bindings, or params can not affect whether a
 * given (policy, binding, param) combination is within its own CEL budget.
 */
class ValidatingAdmissionPolicyBinding implements APIResourceInterface
{
    public const string API_VERSION = 'admissionregistration.k8s.io/v1';
    public const string KIND = 'ValidatingAdmissionPolicyBinding';

    /**
     * Standard object metadata; More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata.
     */
    private ObjectMeta $metadata;

    /**
     * Specification of the desired behavior of the ValidatingAdmissionPolicyBinding.
     */
    private ValidatingAdmissionPolicyBindingSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new ValidatingAdmissionPolicyBindingSpec();
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

    public function setSpec(ValidatingAdmissionPolicyBindingSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function spec(): ValidatingAdmissionPolicyBindingSpec
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
