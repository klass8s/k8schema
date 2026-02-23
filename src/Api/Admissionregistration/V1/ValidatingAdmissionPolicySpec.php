<?php

declare(strict_types=1);

namespace K8Schema\Api\Admissionregistration\V1;

use ArrayObject;
use JsonSerializable;

/**
 * ValidatingAdmissionPolicySpec is the specification of the desired behavior of
 * the AdmissionPolicy.
 */
class ValidatingAdmissionPolicySpec implements JsonSerializable
{
    /**
     * auditAnnotations contains CEL expressions which are used to produce audit
     * annotations for the audit event of the API request. validations and
     * auditAnnotations may not both be empty; a least one of validations or
     * auditAnnotations is required.
     */
    private AuditAnnotationList $auditAnnotations;

    /**
     * failurePolicy defines how to handle failures for the admission policy. Failures
     * can occur from CEL expression parse errors, type check errors, runtime errors
     * and invalid or mis-configured policy definitions or bindings.
     *
     * A policy is invalid if spec.paramKind refers to a non-existent Kind. A binding
     * is invalid if spec.paramRef.name refers to a non-existent resource.
     *
     * failurePolicy does not define how validations that evaluate to false are
     * handled.
     *
     * When failurePolicy is set to Fail, ValidatingAdmissionPolicyBinding
     * validationActions define how failures are enforced.
     *
     * Allowed values are Ignore or Fail. Defaults to Fail.
     */
    private string|null $failurePolicy = null;

    /**
     * MatchConditions is a list of conditions that must be met for a request to be
     * validated. Match conditions filter requests that have already been matched by
     * the rules, namespaceSelector, and objectSelector. An empty list of
     * matchConditions matches all requests. There are a maximum of 64 match conditions
     * allowed.
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
     * MatchConstraints specifies what resources this policy is designed to validate.
     * The AdmissionPolicy cares about a request if it matches _all_ Constraints.
     * However, in order to prevent clusters from being put into an unstable state that
     * cannot be recovered from via the API ValidatingAdmissionPolicy cannot match
     * ValidatingAdmissionPolicy and ValidatingAdmissionPolicyBinding. Required.
     */
    private MatchResources|null $matchConstraints = null;

    /**
     * ParamKind specifies the kind of resources used to parameterize this policy. If
     * absent, there are no parameters for this policy and the param CEL variable will
     * not be provided to validation expressions. If ParamKind refers to a non-existent
     * kind, this policy definition is mis-configured and the FailurePolicy is applied.
     * If paramKind is specified but paramRef is unset in
     * ValidatingAdmissionPolicyBinding, the params variable will be null.
     */
    private ParamKind|null $paramKind = null;

    /**
     * Validations contain CEL expressions which is used to apply the validation.
     * Validations and AuditAnnotations may not both be empty; a minimum of one
     * Validations or AuditAnnotations is required.
     */
    private ValidationList $validations;

    /**
     * Variables contain definitions of variables that can be used in composition of
     * other expressions. Each variable is defined as a named CEL expression. The
     * variables defined here will be available under `variables` in other expressions
     * of the policy except MatchConditions because MatchConditions are evaluated
     * before the rest of the policy.
     *
     * The expression of a variable can refer to other variables defined earlier in the
     * list but not those after. Thus, Variables must be sorted by the order of first
     * appearance and acyclic.
     */
    private VariableList $variables;

    public function __construct()
    {
        $this->auditAnnotations = new AuditAnnotationList();
        $this->matchConditions = new MatchConditionList();
        $this->validations = new ValidationList();
        $this->variables = new VariableList();
    }

    public function auditAnnotations(): AuditAnnotationList
    {
        return $this->auditAnnotations;
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

    public function matchConditions(): MatchConditionList
    {
        return $this->matchConditions;
    }

    public function matchConstraints(): MatchResources
    {
        return $this->matchConstraints ??= new MatchResources();
    }

    public function paramKind(): ParamKind
    {
        return $this->paramKind ??= new ParamKind();
    }

    public function setAuditAnnotations(AuditAnnotationList $auditAnnotations): self
    {
        $this->auditAnnotations = $auditAnnotations;

        return $this;
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

    public function setParamKind(ParamKind $paramKind): self
    {
        $this->paramKind = $paramKind;

        return $this;
    }

    public function setValidations(ValidationList $validations): self
    {
        $this->validations = $validations;

        return $this;
    }

    public function setVariables(VariableList $variables): self
    {
        $this->variables = $variables;

        return $this;
    }

    public function validations(): ValidationList
    {
        return $this->validations;
    }

    public function variables(): VariableList
    {
        return $this->variables;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'auditAnnotations' => $this->auditAnnotations,
            'failurePolicy' => $this->failurePolicy,
            'matchConditions' => $this->matchConditions,
            'matchConstraints' => $this->matchConstraints,
            'paramKind' => $this->paramKind,
            'validations' => $this->validations,
            'variables' => $this->variables,
        ]);
    }
}
