<?php

declare(strict_types=1);

namespace K8Schema\Api\Storagemigration\V1beta1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ConditionList;

/**
 * Status of the storage version migration.
 */
class StorageVersionMigrationStatus implements JsonSerializable
{
    /**
     * The latest available observations of the migration's current state.
     */
    private ConditionList $conditions;

    /**
     * ResourceVersion to compare with the GC cache for performing the migration. This
     * is the current resource version of given group, version and resource when
     * kube-controller-manager first observes this StorageVersionMigration resource.
     */
    private string|null $resourceVersion = null;

    public function __construct()
    {
        $this->conditions = new ConditionList();
    }

    public function conditions(): ConditionList
    {
        return $this->conditions;
    }

    public function getResourceVersion(): string|null
    {
        return $this->resourceVersion;
    }

    public function setConditions(ConditionList $conditions): self
    {
        $this->conditions = $conditions;

        return $this;
    }

    public function setResourceVersion(string $resourceVersion): self
    {
        $this->resourceVersion = $resourceVersion;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'conditions' => $this->conditions,
            'resourceVersion' => $this->resourceVersion,
        ]);
    }
}
