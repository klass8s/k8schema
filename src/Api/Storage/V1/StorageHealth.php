<?php

declare(strict_types=1);

namespace K8Schema\Api\Storage\V1;

use ArrayObject;
use JsonSerializable;

/**
 * StorageHealth contains storage backend health reported by a CSI driver on a
 * node.
 */
class StorageHealth implements JsonSerializable
{
    /**
     * healthConditions are the adverse storage backend conditions reported by the CSI
     * driver. At most 16 conditions may be reported.
     */
    private StorageHealthConditionList $healthConditions;

    /**
     * name is the CSI driver name, matching CSINodeDriver.name.
     */
    private string $name;

    public function __construct(string $name)
    {
        $this->healthConditions = new StorageHealthConditionList();
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function healthConditions(): StorageHealthConditionList
    {
        return $this->healthConditions;
    }

    public function setHealthConditions(StorageHealthConditionList $healthConditions): self
    {
        $this->healthConditions = $healthConditions;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'healthConditions' => $this->healthConditions,
            'name' => $this->name,
        ]);
    }
}
