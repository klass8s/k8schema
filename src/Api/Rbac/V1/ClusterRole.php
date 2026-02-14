<?php

declare(strict_types=1);

namespace K8Schema\Api\Rbac\V1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * ClusterRole is a cluster level, logical grouping of PolicyRules that can be
 * referenced as a unit by a RoleBinding or ClusterRoleBinding.
 */
class ClusterRole implements APIResourceInterface
{
    public const string API_VERSION = 'rbac.authorization.k8s.io/v1';
    public const string KIND = 'ClusterRole';

    /**
     * AggregationRule is an optional field that describes how to build the Rules for
     * this ClusterRole. If AggregationRule is set, then the Rules are controller
     * managed and direct changes to Rules will be stomped by the controller.
     */
    private AggregationRule|null $aggregationRule = null;

    /**
     * Standard object's metadata.
     */
    private ObjectMeta|null $metadata = null;

    /**
     * Rules holds all the PolicyRules for this ClusterRole
     */
    private PolicyRuleList $rules;

    public function __construct()
    {
        $this->rules = new PolicyRuleList();
    }

    public function aggregationRule(): AggregationRule
    {
        return $this->aggregationRule ??= new AggregationRule();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata ??= new ObjectMeta();
    }

    public function rules(): PolicyRuleList
    {
        return $this->rules;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'aggregationRule' => $this->aggregationRule,
            'metadata' => $this->metadata,
            'rules' => $this->rules,
        ]);
    }
}
