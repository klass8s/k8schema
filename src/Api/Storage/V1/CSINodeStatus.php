<?php

declare(strict_types=1);

namespace K8Schema\Api\Storage\V1;

use ArrayObject;
use JsonSerializable;

/**
 * CSINodeStatus contains health and status information for storage on a node.
 */
class CSINodeStatus implements JsonSerializable
{
    /**
     * storageHealth contains backend health reports for CSI drivers registered on the
     * node.
     */
    private StorageHealthList $storageHealth;

    public function __construct()
    {
        $this->storageHealth = new StorageHealthList();
    }

    public function setStorageHealth(StorageHealthList $storageHealth): self
    {
        $this->storageHealth = $storageHealth;

        return $this;
    }

    public function storageHealth(): StorageHealthList
    {
        return $this->storageHealth;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'storageHealth' => $this->storageHealth,
        ]);
    }
}
