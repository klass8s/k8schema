<?php

declare(strict_types=1);

namespace K8Schema\Api\Admissionregistration\V1;

use ArrayObject;
use JsonSerializable;

/**
 * MutatingAdmissionPolicyBindingSpec defines the specification of the
 * MutatingAdmissionPolicyBinding.
 */
class MutatingAdmissionPolicyBindingSpec implements JsonSerializable
{
    /**
     * matchResources limits what resources match this binding and may be mutated by
     * it. Note that if matchResources matches a resource, the resource must also match
     * a policy's matchConstraints and matchConditions before the resource may be
     * mutated. When matchResources is unset, it does not constrain resource matching,
     * and only the policy's matchConstraints and matchConditions must match for the
     * resource to be mutated. Additionally, matchResources.resourceRules are optional
     * and do not constraint matching when unset. Note that this is differs from
     * MutatingAdmissionPolicy matchConstraints, where resourceRules are required. The
     * CREATE, UPDATE and CONNECT operations are allowed.  The DELETE operation may not
     * be matched. '*' matches CREATE, UPDATE and CONNECT.
     */
    private MatchResources|null $matchResources = null;

    /**
     * paramRef specifies the parameter resource used to configure the admission
     * control policy. It should point to a resource of the type specified in
     * spec.ParamKind of the bound MutatingAdmissionPolicy. If the policy specifies a
     * ParamKind and the resource referred to by ParamRef does not exist, this binding
     * is considered mis-configured and the FailurePolicy of the
     * MutatingAdmissionPolicy applied. If the policy does not specify a ParamKind then
     * this field is ignored, and the rules are evaluated without a param.
     */
    private ParamRef|null $paramRef = null;

    /**
     * policyName references a MutatingAdmissionPolicy name which the
     * MutatingAdmissionPolicyBinding binds to. If the referenced resource does not
     * exist, this binding is considered invalid and will be ignored Required.
     */
    private string|null $policyName = null;

    public function __construct()
    {
    }

    public function getMatchResources(): MatchResources|null
    {
        return $this->matchResources;
    }

    public function getParamRef(): ParamRef|null
    {
        return $this->paramRef;
    }

    public function getPolicyName(): string|null
    {
        return $this->policyName;
    }

    public function matchResources(): MatchResources
    {
        return $this->matchResources ??= new MatchResources();
    }

    public function paramRef(): ParamRef
    {
        return $this->paramRef ??= new ParamRef();
    }

    public function setMatchResources(MatchResources $matchResources): self
    {
        $this->matchResources = $matchResources;

        return $this;
    }

    public function setParamRef(ParamRef $paramRef): self
    {
        $this->paramRef = $paramRef;

        return $this;
    }

    public function setPolicyName(string $policyName): self
    {
        $this->policyName = $policyName;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'matchResources' => $this->matchResources,
            'paramRef' => $this->paramRef,
            'policyName' => $this->policyName,
        ]);
    }
}
