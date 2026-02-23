<?php

declare(strict_types=1);

namespace K8Schema\Api\Admissionregistration\V1alpha1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * MutatingAdmissionPolicyBinding binds the MutatingAdmissionPolicy with
 * parametrized resources. MutatingAdmissionPolicyBinding and the optional
 * parameter resource together define how cluster administrators configure policies
 * for clusters.
 *
 * For a given admission request, each binding will cause its policy to be
 * evaluated N times, where N is 1 for policies/bindings that don't use params,
 * otherwise N is the number of parameters selected by the binding. Each evaluation
 * is constrained by a [runtime cost
 * budget](https://kubernetes.io/docs/reference/using-api/cel/#runtime-cost-budget).
 *
 * Adding/removing policies, bindings, or params can not affect whether a given
 * (policy, binding, param) combination is within its own CEL budget.
 */
class MutatingAdmissionPolicyBinding implements APIResourceInterface
{
    public const string API_VERSION = 'admissionregistration.k8s.io/v1alpha1';
    public const string KIND = 'MutatingAdmissionPolicyBinding';

    /**
     * Standard object metadata; More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata.
     */
    private ObjectMeta $metadata;

    /**
     * Specification of the desired behavior of the MutatingAdmissionPolicyBinding.
     */
    private MutatingAdmissionPolicyBindingSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new MutatingAdmissionPolicyBindingSpec();
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

    public function setSpec(MutatingAdmissionPolicyBindingSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function spec(): MutatingAdmissionPolicyBindingSpec
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
