<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringList;
use K8Schema\Collection\StringOrFloatMap;

/**
 * ResourceQuotaSpec defines the desired hard limits to enforce for Quota.
 */
class ResourceQuotaSpec implements JsonSerializable
{
    /**
     * hard is the set of desired hard limits for each named resource. More info:
     * https://kubernetes.io/docs/concepts/policy/resource-quotas/
     */
    private StringOrFloatMap $hard;

    /**
     * scopeSelector is also a collection of filters like scopes that must match each
     * object tracked by a quota but expressed using ScopeSelectorOperator in
     * combination with possible values. For a resource to match, both scopes AND
     * scopeSelector (if specified in spec), must be matched.
     */
    private ScopeSelector|null $scopeSelector = null;

    /**
     * A collection of filters that must match each object tracked by a quota. If not
     * specified, the quota matches all objects.
     */
    private StringList $scopes;

    public function __construct()
    {
        $this->hard = new StringOrFloatMap();
        $this->scopes = new StringList();
    }

    public function hard(): StringOrFloatMap
    {
        return $this->hard;
    }

    public function scopeSelector(): ScopeSelector
    {
        return $this->scopeSelector ??= new ScopeSelector();
    }

    public function scopes(): StringList
    {
        return $this->scopes;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'hard' => $this->hard,
            'scopeSelector' => $this->scopeSelector,
            'scopes' => $this->scopes,
        ]);
    }
}
