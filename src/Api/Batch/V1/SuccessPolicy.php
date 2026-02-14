<?php

declare(strict_types=1);

namespace K8Schema\Api\Batch\V1;

use ArrayObject;
use JsonSerializable;

/**
 * SuccessPolicy describes when a Job can be declared as succeeded based on the
 * success of some indexes.
 */
class SuccessPolicy implements JsonSerializable
{
    /**
     * rules represents the list of alternative rules for the declaring the Jobs as
     * successful before `.status.succeeded >= .spec.completions`. Once any of the
     * rules are met, the "SuccessCriteriaMet" condition is added, and the lingering
     * pods are removed. The terminal state for such a Job has the "Complete"
     * condition. Additionally, these rules are evaluated in order; Once the Job meets
     * one of the rules, other rules are ignored. At most 20 elements are allowed.
     */
    private SuccessPolicyRuleList $rules;

    public function __construct()
    {
        $this->rules = new SuccessPolicyRuleList();
    }

    public function rules(): SuccessPolicyRuleList
    {
        return $this->rules;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'rules' => $this->rules,
        ]);
    }
}
