<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * A null or empty node selector term matches no objects. The requirements of them
 * are ANDed. The TopologySelectorTerm type implements a subset of the
 * NodeSelectorTerm.
 */
class NodeSelectorTerm implements JsonSerializable
{
    /**
     * A list of node selector requirements by node's labels.
     */
    private NodeSelectorRequirementList $matchExpressions;

    /**
     * A list of node selector requirements by node's fields.
     */
    private NodeSelectorRequirementList $matchFields;

    public function __construct()
    {
        $this->matchExpressions = new NodeSelectorRequirementList();
        $this->matchFields = new NodeSelectorRequirementList();
    }

    public function matchExpressions(): NodeSelectorRequirementList
    {
        return $this->matchExpressions;
    }

    public function matchFields(): NodeSelectorRequirementList
    {
        return $this->matchFields;
    }

    public function setMatchExpressions(NodeSelectorRequirementList $matchExpressions): self
    {
        $this->matchExpressions = $matchExpressions;

        return $this;
    }

    public function setMatchFields(NodeSelectorRequirementList $matchFields): self
    {
        $this->matchFields = $matchFields;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'matchExpressions' => $this->matchExpressions,
            'matchFields' => $this->matchFields,
        ]);
    }
}
