<?php

declare(strict_types=1);

namespace K8Schema\Api\Admissionregistration\V1;

use ArrayObject;
use JsonSerializable;

/**
 * MutatingAdmissionPolicySpec defines the desired behavior of the admission
 * policy.
 */
class MutatingAdmissionPolicySpec implements JsonSerializable
{
    /**
     * failurePolicy defines how to handle failures for the admission policy. Failures
     * can occur from CEL expression parse errors, type check errors, runtime errors
     * and invalid or mis-configured policy definitions or bindings.
     *
     * A policy is invalid if paramKind refers to a non-existent Kind. A binding is
     * invalid if paramRef.name refers to a non-existent resource.
     *
     * failurePolicy does not define how validations that evaluate to false are
     * handled.
     *
     * Allowed values are Ignore or Fail. Defaults to Fail.
     */
    private string|null $failurePolicy = null;

    /**
     * matchConditions is a list of conditions that must be met for a request to be
     * validated. Match conditions filter requests that have already been matched by
     * the matchConstraints. An empty list of matchConditions matches all requests.
     * There are a maximum of 64 match conditions allowed.
     *
     * If a parameter object is provided, it can be accessed via the `params` handle in
     * the same manner as validation expressions.
     *
     * The exact matching logic is (in order):
     *   1. If ANY matchCondition evaluates to FALSE, the policy is skipped.
     *   2. If ALL matchConditions evaluate to TRUE, the policy is evaluated.
     *   3. If any matchCondition evaluates to an error (but none are FALSE):
     *      - If failurePolicy=Fail, reject the request
     *      - If failurePolicy=Ignore, the policy is skipped
     */
    private MatchConditionList $matchConditions;

    /**
     * matchConstraints specifies what resources this policy is designed to validate.
     * The MutatingAdmissionPolicy cares about a request if it matches _all_
     * Constraints. However, in order to prevent clusters from being put into an
     * unstable state that cannot be recovered from via the API MutatingAdmissionPolicy
     * cannot match MutatingAdmissionPolicy and MutatingAdmissionPolicyBinding. The
     * CREATE, UPDATE and CONNECT operations are allowed.  The DELETE operation may not
     * be matched. '*' matches CREATE, UPDATE and CONNECT. Required.
     */
    private MatchResources|null $matchConstraints = null;

    /**
     * mutations contain operations to perform on matching objects. mutations may not
     * be empty; a minimum of one mutation is required. mutations are evaluated in
     * order, and are reinvoked according to the reinvocationPolicy. The mutations of a
     * policy are invoked for each binding of this policy and reinvocation of mutations
     * occurs on a per binding basis.
     */
    private MutationList $mutations;

    /**
     * paramKind specifies the kind of resources used to parameterize this policy. If
     * absent, there are no parameters for this policy and the param CEL variable will
     * not be provided to validation expressions. If paramKind refers to a non-existent
     * kind, this policy definition is mis-configured and the FailurePolicy is applied.
     * If paramKind is specified but paramRef is unset in
     * MutatingAdmissionPolicyBinding, the params variable will be null.
     */
    private ParamKind|null $paramKind = null;

    /**
     * reinvocationPolicy indicates whether mutations may be called multiple times per
     * MutatingAdmissionPolicyBinding as part of a single admission evaluation. Allowed
     * values are "Never" and "IfNeeded".
     *
     * Never: These mutations will not be called more than once per binding in a single
     * admission evaluation.
     *
     * IfNeeded: These mutations may be invoked more than once per binding for a single
     * admission request and there is no guarantee of order with respect to other
     * admission plugins, admission webhooks, bindings of this policy and admission
     * policies.  Mutations are only reinvoked when mutations change the object after
     * this mutation is invoked. Required.
     */
    private string|null $reinvocationPolicy = null;

    /**
     * variables contain definitions of variables that can be used in composition of
     * other expressions. Each variable is defined as a named CEL expression. The
     * variables defined here will be available under `variables` in other expressions
     * of the policy except matchConditions because matchConditions are evaluated
     * before the rest of the policy.
     *
     * The expression of a variable can refer to other variables defined earlier in the
     * list but not those after. Thus, variables must be sorted by the order of first
     * appearance and acyclic.
     */
    private VariableList $variables;

    public function __construct()
    {
        $this->matchConditions = new MatchConditionList();
        $this->mutations = new MutationList();
        $this->variables = new VariableList();
    }

    public function getFailurePolicy(): string|null
    {
        return $this->failurePolicy;
    }

    public function getMatchConstraints(): MatchResources|null
    {
        return $this->matchConstraints;
    }

    public function getParamKind(): ParamKind|null
    {
        return $this->paramKind;
    }

    public function getReinvocationPolicy(): string|null
    {
        return $this->reinvocationPolicy;
    }

    public function matchConditions(): MatchConditionList
    {
        return $this->matchConditions;
    }

    public function matchConstraints(): MatchResources
    {
        return $this->matchConstraints ??= new MatchResources();
    }

    public function mutations(): MutationList
    {
        return $this->mutations;
    }

    public function paramKind(): ParamKind
    {
        return $this->paramKind ??= new ParamKind();
    }

    public function setFailurePolicy(string $failurePolicy): self
    {
        $this->failurePolicy = $failurePolicy;

        return $this;
    }

    public function setMatchConditions(MatchConditionList $matchConditions): self
    {
        $this->matchConditions = $matchConditions;

        return $this;
    }

    public function setMatchConstraints(MatchResources $matchConstraints): self
    {
        $this->matchConstraints = $matchConstraints;

        return $this;
    }

    public function setMutations(MutationList $mutations): self
    {
        $this->mutations = $mutations;

        return $this;
    }

    public function setParamKind(ParamKind $paramKind): self
    {
        $this->paramKind = $paramKind;

        return $this;
    }

    public function setReinvocationPolicy(string $reinvocationPolicy): self
    {
        $this->reinvocationPolicy = $reinvocationPolicy;

        return $this;
    }

    public function setVariables(VariableList $variables): self
    {
        $this->variables = $variables;

        return $this;
    }

    public function variables(): VariableList
    {
        return $this->variables;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'failurePolicy' => $this->failurePolicy,
            'matchConditions' => $this->matchConditions,
            'matchConstraints' => $this->matchConstraints,
            'mutations' => $this->mutations,
            'paramKind' => $this->paramKind,
            'reinvocationPolicy' => $this->reinvocationPolicy,
            'variables' => $this->variables,
        ]);
    }
}
