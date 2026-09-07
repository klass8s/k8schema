<?php

declare(strict_types=1);

namespace K8Schema\Api\Authorization\V1;

use ArrayObject;
use JsonSerializable;

/**
 * SubjectRulesReviewStatus contains the result of a rules check. This check can be
 * incomplete depending on the set of authorizers the server is configured with and
 * any errors experienced during evaluation. Because authorization rules are
 * additive, if a rule appears in a list it's safe to assume the subject has that
 * permission, even if that list is incomplete.
 */
class SubjectRulesReviewStatus implements JsonSerializable
{
    /**
     * evaluationError can appear in combination with Rules. It indicates an error
     * occurred during rule evaluation, such as an authorizer that doesn't support rule
     * evaluation, and that ResourceRules and/or NonResourceRules may be incomplete.
     */
    private string|null $evaluationError = null;

    /**
     * incomplete is true when the rules returned by this call are incomplete. This is
     * most commonly encountered when an authorizer, such as an external authorizer,
     * doesn't support rules evaluation.
     */
    private bool $incomplete;

    /**
     * nonResourceRules is the list of actions the subject is allowed to perform on
     * non-resources. The list ordering isn't significant, may contain duplicates, and
     * possibly be incomplete.
     */
    private NonResourceRuleList $nonResourceRules;

    /**
     * resourceRules is the list of actions the subject is allowed to perform on
     * resources. The list ordering isn't significant, may contain duplicates, and
     * possibly be incomplete.
     */
    private ResourceRuleList $resourceRules;

    public function __construct(bool $incomplete)
    {
        $this->incomplete = $incomplete;
        $this->nonResourceRules = new NonResourceRuleList();
        $this->resourceRules = new ResourceRuleList();
    }

    public function getEvaluationError(): string|null
    {
        return $this->evaluationError;
    }

    public function getIncomplete(): bool
    {
        return $this->incomplete;
    }

    public function nonResourceRules(): NonResourceRuleList
    {
        return $this->nonResourceRules;
    }

    public function resourceRules(): ResourceRuleList
    {
        return $this->resourceRules;
    }

    public function setEvaluationError(string $evaluationError): self
    {
        $this->evaluationError = $evaluationError;

        return $this;
    }

    public function setIncomplete(bool $incomplete): self
    {
        $this->incomplete = $incomplete;

        return $this;
    }

    public function setNonResourceRules(NonResourceRuleList $nonResourceRules): self
    {
        $this->nonResourceRules = $nonResourceRules;

        return $this;
    }

    public function setResourceRules(ResourceRuleList $resourceRules): self
    {
        $this->resourceRules = $resourceRules;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'evaluationError' => $this->evaluationError,
            'incomplete' => $this->incomplete,
            'nonResourceRules' => $this->nonResourceRules,
            'resourceRules' => $this->resourceRules,
        ]);
    }
}
