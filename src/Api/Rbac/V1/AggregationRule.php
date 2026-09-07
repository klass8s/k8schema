<?php

declare(strict_types=1);

namespace K8Schema\Api\Rbac\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\LabelSelectorList;

/**
 * AggregationRule describes how to locate ClusterRoles to aggregate into the
 * ClusterRole
 */
class AggregationRule implements JsonSerializable
{
    /**
     * clusterRoleSelectors holds a list of selectors which will be used to find
     * ClusterRoles and create the rules. If any of the selectors match, then the
     * ClusterRole's permissions will be added
     */
    private LabelSelectorList $clusterRoleSelectors;

    public function __construct()
    {
        $this->clusterRoleSelectors = new LabelSelectorList();
    }

    public function clusterRoleSelectors(): LabelSelectorList
    {
        return $this->clusterRoleSelectors;
    }

    public function setClusterRoleSelectors(LabelSelectorList $clusterRoleSelectors): self
    {
        $this->clusterRoleSelectors = $clusterRoleSelectors;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'clusterRoleSelectors' => $this->clusterRoleSelectors,
        ]);
    }
}
