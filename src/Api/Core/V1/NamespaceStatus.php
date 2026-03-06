<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * NamespaceStatus is information about the current status of a Namespace.
 */
class NamespaceStatus implements JsonSerializable
{
    /**
     * Represents the latest available observations of a namespace's current state.
     */
    private NamespaceConditionList $conditions;

    /**
     * Phase is the current lifecycle phase of the namespace. More info:
     * https://kubernetes.io/docs/tasks/administer-cluster/namespaces/
     */
    private string|null $phase = null;

    public function __construct()
    {
        $this->conditions = new NamespaceConditionList();
    }

    public function conditions(): NamespaceConditionList
    {
        return $this->conditions;
    }

    public function getPhase(): string|null
    {
        return $this->phase;
    }

    public function setConditions(NamespaceConditionList $conditions): self
    {
        $this->conditions = $conditions;

        return $this;
    }

    public function setPhase(string $phase): self
    {
        $this->phase = $phase;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'conditions' => $this->conditions,
            'phase' => $this->phase,
        ]);
    }
}
