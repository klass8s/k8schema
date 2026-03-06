<?php

declare(strict_types=1);

namespace K8Schema\ApiextensionsApiserver\Pkg\Apis\Apiextensions\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringList;

/**
 * CustomResourceDefinitionStatus indicates the state of the
 * CustomResourceDefinition
 */
class CustomResourceDefinitionStatus implements JsonSerializable
{
    /**
     * acceptedNames are the names that are actually being used to serve discovery.
     * They may be different than the names in spec.
     */
    private CustomResourceDefinitionNames|null $acceptedNames = null;

    /**
     * conditions indicate state for particular aspects of a CustomResourceDefinition
     */
    private CustomResourceDefinitionConditionList $conditions;

    /**
     * storedVersions lists all versions of CustomResources that were ever persisted.
     * Tracking these versions allows a migration path for stored versions in etcd. The
     * field is mutable so a migration controller can finish a migration to another
     * version (ensuring no old objects are left in storage), and then remove the rest
     * of the versions from this list. Versions may not be removed from `spec.versions`
     * while they exist in this list.
     */
    private StringList $storedVersions;

    public function __construct()
    {
        $this->conditions = new CustomResourceDefinitionConditionList();
        $this->storedVersions = new StringList();
    }

    public function conditions(): CustomResourceDefinitionConditionList
    {
        return $this->conditions;
    }

    public function getAcceptedNames(): CustomResourceDefinitionNames|null
    {
        return $this->acceptedNames;
    }

    public function setAcceptedNames(CustomResourceDefinitionNames $acceptedNames): self
    {
        $this->acceptedNames = $acceptedNames;

        return $this;
    }

    public function setConditions(CustomResourceDefinitionConditionList $conditions): self
    {
        $this->conditions = $conditions;

        return $this;
    }

    public function setStoredVersions(StringList $storedVersions): self
    {
        $this->storedVersions = $storedVersions;

        return $this;
    }

    public function storedVersions(): StringList
    {
        return $this->storedVersions;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'acceptedNames' => $this->acceptedNames,
            'conditions' => $this->conditions,
            'storedVersions' => $this->storedVersions,
        ]);
    }
}
