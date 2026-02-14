<?php

declare(strict_types=1);

namespace K8Schema\Api\Rbac\V1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * Role is a namespaced, logical grouping of PolicyRules that can be referenced as
 * a unit by a RoleBinding.
 */
class Role implements APIResourceInterface
{
    public const string API_VERSION = 'rbac.authorization.k8s.io/v1';
    public const string KIND = 'Role';

    /**
     * Standard object's metadata.
     */
    private ObjectMeta|null $metadata = null;

    /**
     * Rules holds all the PolicyRules for this Role
     */
    private PolicyRuleList $rules;

    public function __construct()
    {
        $this->rules = new PolicyRuleList();
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
            'metadata' => $this->metadata,
            'rules' => $this->rules,
        ]);
    }
}
