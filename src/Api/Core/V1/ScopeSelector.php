<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use JsonSerializable;

/**
 * A scope selector represents the AND of the selectors represented by the
 * scoped-resource selector requirements.
 */
class ScopeSelector implements JsonSerializable
{
    /**
     * A list of scope selector requirements by scope of the resources.
     */
    private ScopedResourceSelectorRequirementList $matchExpressions;

    public function __construct()
    {
        $this->matchExpressions = new ScopedResourceSelectorRequirementList();
    }

    public function matchExpressions(): ScopedResourceSelectorRequirementList
    {
        return $this->matchExpressions;
    }

    public function jsonSerialize(): array
    {
        return [
            'matchExpressions' => $this->matchExpressions,
        ];
    }
}
